<?php

namespace App\Http\Controllers\Recruiter;

use App\Enums\InterviewStatus;
use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use App\Models\UserNotification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
                'Programmé'  => InterviewStatus::Programme->value,
                'Confirmé'   => InterviewStatus::Confirme->value,
                'En attente' => InterviewStatus::EnAttente->value,
                'Terminé'    => InterviewStatus::Termine->value,
                'Annulé'     => InterviewStatus::Annule->value,
            ];
            
            if (isset($statusMap[$status])) {
                $query->withStatus($statusMap[$status]);
            }
        }

        $interviews = $query->paginate(10);

        // Get notification read status for each interview
        $candidateIds = $interviews->pluck('candidate_id')->unique()->toArray();
        
        // Get ALL notifications for these candidates (not just interview type) to check read status
        $allNotifications = UserNotification::whereIn('user_id', $candidateIds)
            ->with('notification')
            ->get()
            ->groupBy('user_id');

        // Get interview-related notifications specifically
        $interviewNotifications = UserNotification::whereIn('user_id', $candidateIds)
            ->with('notification')
            ->whereHas('notification', function($q) {
                $q->whereIn('type', ['interview', 'interview_update']);
            })
            ->get()
            ->groupBy('user_id');

        // Add notification read status to each interview
        $interviews->getCollection()->transform(function($interview) use ($interviewNotifications, $allNotifications) {
            // Get all interview notifications for this candidate
            $candidateInterviewNotifications = $interviewNotifications->get($interview->candidate_id, collect());
            
            // Try to find the specific notification for THIS interview
            // Match by job title from notification and time window around interview creation
            $readNotification = null;
            
            if ($candidateInterviewNotifications->isNotEmpty()) {
                // Get job title for matching
                $jobTitle = $interview->job->title ?? null;
                $interviewCreatedAt = $interview->created_at;
                
                // Find notifications that match this interview by job title and time
                $matchingNotifications = $candidateInterviewNotifications->filter(function($userNotification) use ($jobTitle, $interviewCreatedAt) {
                    if (!$userNotification->notification) {
                        return false;
                    }
                    
                    // Check if notification title/message contains the job title
                    $notificationTitle = $userNotification->notification->title ?? '';
                    $notificationMessage = $userNotification->notification->message ?? '';
                    $notificationCreatedAt = $userNotification->created_at;
                    
                    // Check if job title matches exactly (extract from notification title pattern: "Nouvel entretien programmé - {Job Title}")
                    $titleMatches = false;
                    if ($jobTitle && preg_match('/- (.+)$/', $notificationTitle, $matches)) {
                        $extractedJobTitle = trim($matches[1]);
                        // Use exact match first (most reliable)
                        $titleMatches = ($extractedJobTitle === $jobTitle);
                    }
                    
                    // If title doesn't match exactly, check if message contains job title in quotes (more specific)
                    $messageMatches = false;
                    if (!$titleMatches && $jobTitle) {
                        // Look for "poste "{Job Title}"" pattern for exact match
                        if (preg_match('/poste "([^"]+)"/', $notificationMessage, $msgMatches)) {
                            $extractedJobTitle = trim($msgMatches[1]);
                            $messageMatches = ($extractedJobTitle === $jobTitle);
                        } else {
                            // Fallback to contains check
                            $messageMatches = str_contains($notificationMessage, $jobTitle);
                        }
                    }
                    
                    // Check if notification was created around the same time as interview (within 5 minutes - tighter window)
                    $timeMatches = abs($notificationCreatedAt->diffInMinutes($interviewCreatedAt)) <= 5;
                    
                    // Require both job title match AND time match to avoid false positives
                    return ($titleMatches || $messageMatches) && $timeMatches;
                });
                
                // Check if the matching notification is read
                $readNotification = $matchingNotifications->where('is_read', true)->first();
            }
            
            // If no specific match found, don't mark as read (interview-specific notification must exist and be read)
            // We don't use fallback to other notification types to avoid false positives
            
            $interview->notification_read = $readNotification ? true : false;
            $interview->notification_read_at = $readNotification ? $readNotification->read_at : null;
            return $interview;
        });

        // Calculate statistics
        $stats = [
            'total'      => Interview::forRecruiter($user->id)->count(),
            'programme'  => Interview::forRecruiter($user->id)->withStatus(InterviewStatus::Programme->value)->count(),
            'confirme'   => Interview::forRecruiter($user->id)->withStatus(InterviewStatus::Confirme->value)->count(),
            'en_attente' => Interview::forRecruiter($user->id)->withStatus(InterviewStatus::EnAttente->value)->count(),
            'termine'    => Interview::forRecruiter($user->id)->withStatus(InterviewStatus::Termine->value)->count(),
            'annule'     => Interview::forRecruiter($user->id)->withStatus(InterviewStatus::Annule->value)->count(),
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
            ->where('status', '!=', InterviewStatus::Annule->value)
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
            'status' => InterviewStatus::Programme->value,
        ]);

        // Load relationships needed for notification
        $interview->load(['candidate', 'job.company', 'application']);
        
        // Ensure application has job with company loaded
        if (!$application->relationLoaded('job')) {
            $application->load('job.company');
        }

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
            ->where('status', '!=', InterviewStatus::Annule->value)
            ->where('id', '!=', $interview->id)
            ->exists();

        if ($conflictExists) {
            return back()->withErrors(['start_time' => 'Vous avez déjà un entretien programmé à cette heure.']);
        }

        $oldStatus = $interview->status;
        
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

        // Reload interview with relationships
        $interview->load(['candidate', 'job.company', 'application']);
        
        // Send notification to candidate about interview update
        $this->sendInterviewUpdateNotification($interview);

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
            'status' => 'required|in:' . InterviewStatus::validationRule(),
        ]);

        $oldStatus = $interview->status;
        $interview->update(['status' => $request->status]);
        
        // Reload interview with relationships
        $interview->load(['candidate', 'job.company', 'application']);

        // Send notification to candidate about status change
        $this->sendStatusChangeNotification($interview, $oldStatus, $request->status);

        $statusLabel = InterviewStatus::from($request->status)->label();

        return back()->with('success', "Statut de l'entretien mis à jour: {$statusLabel}");
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

        // Load relationships before deleting for notification
        $interview->load(['candidate', 'job.company', 'application']);
        
        // Send notification to candidate about interview cancellation/deletion
        $this->sendInterviewDeletionNotification($interview);

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
            // Ensure relationships are loaded
            if (!$interview->relationLoaded('candidate')) {
                $interview->load('candidate');
            }
            if (!$interview->relationLoaded('job')) {
                $interview->load('job');
            }
            if (!$application->relationLoaded('job')) {
                $application->load('job');
            }
            
            $notificationService = new NotificationService();
            
            // Format the interview date and time
            $interviewDate = $interview->interview_date->format('d/m/Y');
            
            // Parse start_time - handle both string and datetime formats
            try {
                if ($interview->start_time instanceof \DateTime || $interview->start_time instanceof \Carbon\Carbon) {
                    $interviewTime = $interview->start_time->format('H:i');
                } else {
                    $interviewTime = Carbon::parse($interview->start_time)->format('H:i');
                }
            } catch (\Exception $e) {
                // Fallback: use the raw value if parsing fails
                $interviewTime = is_string($interview->start_time) ? $interview->start_time : '00:00';
            }
            $duration = $interview->duration_minutes;
            
            // Get type in French
            $typeInFrench = match($interview->type) {
                'visioconference' => 'Visioconférence',
                'presentiel' => 'Présentiel',
                'telephonique' => 'Téléphonique',
                default => $interview->type
            };
            
            // Create notification title
            $title = "Nouvel entretien programmé - {$application->job->title}";
            
            // Create simple notification message (details are shown in the interview details section)
            $companyName = $application->job->company->name ?? 'l\'entreprise';
            $message = "Un entretien a été programmé pour le poste \"{$application->job->title}\" chez {$companyName}. Consultez les détails ci-dessous.";
            
            // Send notification to the candidate
            $notification = $notificationService->createNotification(
                $title,
                $message,
                'interview',
                [$interview->candidate_id]
            );
            
            \Log::info('Interview notification sent successfully. Notification ID: ' . $notification->id);
            
        } catch (\Exception $e) {
            \Log::error('Failed to send interview notification: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            // Don't fail the interview creation, but log the error
        }
    }

    /**
     * Send interview update notification to candidate
     */
    private function sendInterviewUpdateNotification($interview)
    {
        try {
            // Ensure relationships are loaded
            if (!$interview->relationLoaded('candidate')) {
                $interview->load('candidate');
            }
            if (!$interview->relationLoaded('job')) {
                $interview->load('job.company');
            }
            
            $notificationService = new NotificationService();
            
            // Create notification title
            $title = "Mise à jour de votre entretien - {$interview->job->title}";
            
            // Create simple notification message (details shown in interview details section)
            $companyName = $interview->job->company->name ?? 'l\'entreprise';
            $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} a été mis à jour. Consultez les détails ci-dessous.";
            
            // Send notification to the candidate
            $notification = $notificationService->createNotification(
                $title,
                $message,
                'interview_update',
                [$interview->candidate_id]
            );
            
            \Log::info('Interview update notification sent successfully. Notification ID: ' . $notification->id);
            
        } catch (\Exception $e) {
            \Log::error('Failed to send interview update notification: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            // Don't fail the interview update, but log the error
        }
    }

    /**
     * Send interview deletion notification to candidate
     */
    private function sendInterviewDeletionNotification($interview)
    {
        try {
            // Ensure relationships are loaded
            if (!$interview->relationLoaded('candidate')) {
                $interview->load('candidate');
            }
            if (!$interview->relationLoaded('job')) {
                $interview->load('job.company');
            }
            
            $notificationService = new NotificationService();
            
            // Create notification title
            $title = "Entretien annulé - {$interview->job->title}";
            
            // Create simple notification message
            $companyName = $interview->job->company->name ?? 'l\'entreprise';
            $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} a été annulé.";
            
            // Send notification to the candidate
            $notification = $notificationService->createNotification(
                $title,
                $message,
                'interview_update',
                [$interview->candidate_id]
            );
            
            \Log::info('Interview deletion notification sent successfully. Notification ID: ' . $notification->id);
            
        } catch (\Exception $e) {
            \Log::error('Failed to send interview deletion notification: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            // Don't fail the interview deletion, but log the error
        }
    }

    /**
     * Send status change notification to candidate
     */
    private function sendStatusChangeNotification($interview, $oldStatus, $newStatus)
    {
        try {
            // Ensure relationships are loaded
            if (!$interview->relationLoaded('candidate')) {
                $interview->load('candidate');
            }
            if (!$interview->relationLoaded('job')) {
                $interview->load('job.company');
            }
            
            $notificationService = new NotificationService();
            
            // Create notification title
            $title = "Mise à jour de votre entretien - {$interview->job->title}";
            
            // Create simple notification message based on status change (details shown in interview details section)
            $companyName = $interview->job->company->name ?? 'l\'entreprise';
            
            switch ($newStatus) {
                case InterviewStatus::Confirme->value:
                    $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} a été confirmé. Consultez les détails ci-dessous.";
                    break;
                case InterviewStatus::Annule->value:
                    $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} a été annulé. Consultez les détails ci-dessous.";
                    break;
                case InterviewStatus::Termine->value:
                    $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} est terminé. Merci pour votre participation !";
                    break;
                case InterviewStatus::EnAttente->value:
                    $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} est en attente de confirmation. Consultez les détails ci-dessous.";
                    break;
                default:
                    $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} a été mis à jour. Consultez les détails ci-dessous.";
                    break;
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
