<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class InterviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.user.type:recruiter');
    }

    /**
     * Display a listing of interviews for the recruiter.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get all interviews for this recruiter
        $query = Interview::forRecruiter($user->id)
            ->with(['candidate', 'job', 'application'])
            ->orderBy('interview_date', 'desc')
            ->orderBy('start_time', 'desc');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('candidate', function($candidateQuery) use ($search) {
                    $candidateQuery->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('job', function($jobQuery) use ($search) {
                    $jobQuery->where('title', 'like', "%{$search}%");
                });
            });
        }

        // Apply status filter
        if ($request->filled('status')) {
            $status = $request->status;
            $statusMap = [
                'Programmé' => 'programme',
                'Confirmé' => 'confirme',
                'En attente' => 'en_attente',
                'Terminé' => 'termine',
                'Annulé' => 'annule'
            ];
            
            if (isset($statusMap[$status])) {
                $query->withStatus($statusMap[$status]);
            }
        }

        $interviews = $query->paginate(10);

        // Calculate statistics
        $stats = [
            'total' => Interview::forRecruiter($user->id)->count(),
            'programme' => Interview::forRecruiter($user->id)->withStatus('programme')->count(),
            'confirme' => Interview::forRecruiter($user->id)->withStatus('confirme')->count(),
            'en_attente' => Interview::forRecruiter($user->id)->withStatus('en_attente')->count(),
            'termine' => Interview::forRecruiter($user->id)->withStatus('termine')->count(),
            'annule' => Interview::forRecruiter($user->id)->withStatus('annule')->count(),
        ];

        return view('dashboard.recruiter.interviews', compact('interviews', 'stats'));
    }

    /**
     * Show the form for creating a new interview.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        
        // Get applications that can have interviews scheduled
        $applications = Application::whereHas('job', function($query) use ($user) {
            $query->where('recruiter_id', $user->id);
        })
        ->whereIn('status', ['shortlisted', 'accepted', 'reviewed'])
        ->with(['candidate', 'job'])
        ->get();

        // If application_id is provided, pre-select that application
        $selectedApplication = null;
        if ($request->filled('application_id')) {
            $selectedApplication = $applications->find($request->application_id);
        }

        return view('dashboard.recruiter.schedule-interview', compact('applications', 'selectedApplication'));
    }

    /**
     * Store a newly created interview.
     */
    public function store(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
            'interview_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'duration_minutes' => 'required|integer|min:15|max:480', // 15 minutes to 8 hours
            'type' => 'required|in:visioconference,presentiel,telephonique',
            'location' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
            'meeting_link' => 'nullable|url|max:500',
            'meeting_id' => 'nullable|string|max:100',
            'meeting_password' => 'nullable|string|max:50',
        ]);

        $user = Auth::user();
        
        // Get the application and verify it belongs to this recruiter
        $application = Application::whereHas('job', function($query) use ($user) {
            $query->where('recruiter_id', $user->id);
        })->findOrFail($request->application_id);

        // Check for time conflicts
        $conflictExists = Interview::forRecruiter($user->id)
            ->where('interview_date', $request->interview_date)
            ->where('start_time', $request->start_time)
            ->where('status', '!=', 'annule')
            ->exists();

        if ($conflictExists) {
            return back()->withErrors(['start_time' => 'Vous avez déjà un entretien programmé à cette heure.']);
        }

        // Create the interview
        $interview = Interview::create([
            'recruiter_id' => $user->id,
            'candidate_id' => $application->candidate_id,
            'job_id' => $application->job_id,
            'application_id' => $application->id,
            'interview_date' => $request->interview_date,
            'start_time' => $request->start_time,
            'duration_minutes' => $request->duration_minutes,
            'type' => $request->type,
            'location' => $request->location,
            'notes' => $request->notes,
            'meeting_link' => $request->meeting_link,
            'meeting_id' => $request->meeting_id,
            'meeting_password' => $request->meeting_password,
            'status' => 'programme',
        ]);

        // Send notification to candidate
        $this->sendInterviewNotification($interview, $application);

        return redirect()->route('recruiter.interviews')
            ->with('success', 'Entretien programmé avec succès.');
    }

    /**
     * Display the specified interview.
     */
    public function show(Interview $interview)
    {
        // Check if the interview belongs to the authenticated recruiter
        if ($interview->recruiter_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this interview.');
        }

        $interview->load(['candidate', 'job', 'application']);

        return view('dashboard.recruiter.interview-detail', compact('interview'));
    }

    /**
     * Show the form for editing the specified interview.
     */
    public function edit(Interview $interview)
    {
        // Check if the interview belongs to the authenticated recruiter
        if ($interview->recruiter_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this interview.');
        }

        $interview->load(['candidate', 'job', 'application']);

        return view('dashboard.recruiter.edit-interview', compact('interview'));
    }

    /**
     * Update the specified interview.
     */
    public function update(Request $request, Interview $interview)
    {
        // Check if the interview belongs to the authenticated recruiter
        if ($interview->recruiter_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this interview.');
        }

        $request->validate([
            'interview_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'duration_minutes' => 'required|integer|min:15|max:480',
            'type' => 'required|in:visioconference,presentiel,telephonique',
            'location' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
            'meeting_link' => 'nullable|url|max:500',
            'meeting_id' => 'nullable|string|max:100',
            'meeting_password' => 'nullable|string|max:50',
        ]);

        // Check for time conflicts (excluding current interview)
        $conflictExists = Interview::forRecruiter(Auth::id())
            ->where('interview_date', $request->interview_date)
            ->where('start_time', $request->start_time)
            ->where('status', '!=', 'annule')
            ->where('id', '!=', $interview->id)
            ->exists();

        if ($conflictExists) {
            return back()->withErrors(['start_time' => 'Vous avez déjà un entretien programmé à cette heure.']);
        }

        $interview->update($request->only([
            'interview_date',
            'start_time',
            'duration_minutes',
            'type',
            'location',
            'notes',
            'meeting_link',
            'meeting_id',
            'meeting_password',
        ]));

        return redirect()->route('recruiter.interviews')
            ->with('success', 'Entretien mis à jour avec succès.');
    }

    /**
     * Update the status of the specified interview.
     */
    public function updateStatus(Request $request, Interview $interview)
    {
        // Check if the interview belongs to the authenticated recruiter
        if ($interview->recruiter_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this interview.');
        }

        $request->validate([
            'status' => 'required|in:programme,confirme,en_attente,annule,termine',
        ]);

        $oldStatus = $interview->status;
        $interview->update(['status' => $request->status]);

        // Send notification to candidate about status change
        $this->sendStatusChangeNotification($interview, $oldStatus, $request->status);

        $statusMap = [
            'programme' => 'Programmé',
            'confirme' => 'Confirmé',
            'en_attente' => 'En attente',
            'annule' => 'Annulé',
            'termine' => 'Terminé',
        ];

        return back()->with('success', "Statut de l'entretien mis à jour: {$statusMap[$request->status]}");
    }

    /**
     * Remove the specified interview.
     */
    public function destroy(Interview $interview)
    {
        // Check if the interview belongs to the authenticated recruiter
        if ($interview->recruiter_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this interview.');
        }

        $interview->delete();

        return redirect()->route('recruiter.interviews')
            ->with('success', 'Entretien supprimé avec succès.');
    }

    /**
     * Get interviews for calendar view.
     */
    public function calendar(Request $request)
    {
        $user = Auth::user();
        
        $startDate = $request->get('start', Carbon::now()->startOfMonth());
        $endDate = $request->get('end', Carbon::now()->endOfMonth());

        $interviews = Interview::forRecruiter($user->id)
            ->inDateRange($startDate, $endDate)
            ->with(['candidate', 'job'])
            ->get()
            ->map(function($interview) {
                return [
                    'id' => $interview->id,
                    'title' => $interview->candidate->name . ' - ' . $interview->job->title,
                    'start' => $interview->interview_date->format('Y-m-d') . 'T' . $interview->start_time->format('H:i:s'),
                    'end' => $interview->interview_date->format('Y-m-d') . 'T' . $interview->start_time->addMinutes($interview->duration_minutes)->format('H:i:s'),
                    'type' => $interview->type,
                    'status' => $interview->status,
                    'location' => $interview->location,
                    'notes' => $interview->notes,
                ];
            });

        return response()->json($interviews);
    }

    /**
     * Send interview notification to candidate
     */
    private function sendInterviewNotification($interview, $application)
    {
        try {
            $notificationService = new NotificationService();
            
            // Format the interview date and time
            $interviewDate = Carbon::parse($interview->interview_date)->format('d/m/Y');
            $interviewTime = Carbon::parse($interview->start_time)->format('H:i');
            $duration = $interview->duration_minutes;
            
            // Create notification title
            $title = "Nouvel entretien programmé - {$application->job->title}";
            
            // Create notification message with all interview details
            $message = "Bonjour {$interview->candidate->name},\n\n";
            $message .= "Un entretien a été programmé pour le poste de {$application->job->title}.\n\n";
            $message .= "📅 Date : {$interviewDate}\n";
            $message .= "🕐 Heure : {$interviewTime} ({$duration} minutes)\n";
            $message .= "📍 Type : {$interview->type_in_french}\n";
            $message .= "🏢 Lieu : {$interview->location}\n";
            
            if ($interview->notes) {
                $message .= "📝 Notes : {$interview->notes}\n";
            }
            
            if ($interview->type === 'visioconference' && $interview->meeting_link) {
                $message .= "🔗 Lien de la réunion : {$interview->meeting_link}\n";
            }
            
            $message .= "\nBonne chance pour votre entretien !";
            
            // Send notification to the candidate
            $notificationService->createNotification(
                $title,
                $message,
                'interview',
                [$interview->candidate_id]
            );
            
        } catch (\Exception $e) {
            // Log the error but don't fail the interview creation
        }
    }

    /**
     * Send status change notification to candidate
     */
    private function sendStatusChangeNotification($interview, $oldStatus, $newStatus)
    {
        try {
            $notificationService = new NotificationService();
            
            // Format the interview date and time
            $interviewDate = Carbon::parse($interview->interview_date)->format('d/m/Y');
            $interviewTime = Carbon::parse($interview->start_time)->format('H:i');
            
            // Status mapping
            $statusMap = [
                'programme' => 'Programmé',
                'confirme' => 'Confirmé',
                'en_attente' => 'En attente',
                'annule' => 'Annulé',
                'termine' => 'Terminé',
            ];
            
            // Create notification title
            $title = "Mise à jour de votre entretien - {$interview->job->title}";
            
            // Create notification message based on status change
            $message = "Bonjour {$interview->candidate->name},\n\n";
            $message .= "Le statut de votre entretien pour le poste de {$interview->job->title} a été mis à jour.\n\n";
            $message .= "📅 Date : {$interviewDate}\n";
            $message .= "🕐 Heure : {$interviewTime}\n";
            $message .= "📍 Type : {$interview->type_in_french}\n";
            $message .= "🏢 Lieu : {$interview->location}\n";
            $message .= "📊 Nouveau statut : {$statusMap[$newStatus]}\n\n";
            
            // Add specific message based on status
            switch ($newStatus) {
                case 'confirme':
                    $message .= "✅ Votre entretien est confirmé. Nous vous attendons !\n";
                    if ($interview->type === 'visioconference' && $interview->meeting_link) {
                        $message .= "🔗 Lien de la réunion : {$interview->meeting_link}\n";
                    }
                    break;
                case 'annule':
                    $message .= "❌ Votre entretien a été annulé. Nous vous contacterons pour reprogrammer.\n";
                    break;
                case 'termine':
                    $message .= "✅ Votre entretien est terminé. Merci pour votre participation !\n";
                    break;
                case 'en_attente':
                    $message .= "⏳ Votre entretien est en attente de confirmation.\n";
                    break;
                default:
                    $message .= "📋 Votre entretien a été mis à jour.\n";
                    break;
            }
            
            if ($interview->notes) {
                $message .= "\n📝 Notes : {$interview->notes}";
            }
            
            // Send notification to the candidate
            $notificationService->createNotification(
                $title,
                $message,
                'interview_update',
                [$interview->candidate_id]
            );
            
        } catch (\Exception $e) {
            // Log the error but don't fail the status update
        }
    }
}
