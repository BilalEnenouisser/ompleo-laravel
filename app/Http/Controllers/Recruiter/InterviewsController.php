<?php

namespace App\Http\Controllers\Recruiter;

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
        $this->authorize('scanner-pass');
        $this->middleware('auth');
        $this->middleware('check.user.type:recruiter');
    }

    /**
     * Display a listing of interviews for the recruiter.
     */
    public function index(Request $request)
    {
        $this->authorize('scanner-pass'); $user = Auth::user(); $query = Interview::forRecruiter($user->id) ->with(['candidate', 'job', 'application']) ->orderBy('interview_date', 'desc') ->orderBy('start_time', 'desc'); if ($request->filled('search')) { $search = $request->search; $query->where(function($q) use ($search) { $q->whereHas('candidate', function($candidateQuery) use ($search) { $candidateQuery->where('name', 'like', "%{$search}%"); }) ->orWhereHas('job', function($jobQuery) use ($search) { $jobQuery->where('title', 'like', "%{$search}%"); }); }); } if ($request->filled('status')) { $status = $request->status; $statusMap = [ 'Programmé' => 'programme', 'Confirmé' => 'confirme', 'En attente' => 'en_attente', 'Terminé' => 'termine', 'Annulé' => 'annule' ]; if (isset($statusMap[$status])) { $query->withStatus($statusMap[$status]); } } $interviews = $query->paginate(10); $candidateIds = $interviews->pluck('candidate_id')->unique()->toArray(); $allNotifications = UserNotification::whereIn('user_id', $candidateIds) ->with('notification') ->get() ->groupBy('user_id'); $interviewNotifications = UserNotification::whereIn('user_id', $candidateIds) ->with('notification') ->whereHas('notification', function($q) { $q->whereIn('type', ['interview', 'interview_update']); }) ->get() ->groupBy('user_id'); $interviews->getCollection()->transform(function($interview) use ($interviewNotifications, $allNotifications) { $candidateInterviewNotifications = $interviewNotifications->get($interview->candidate_id, collect()); $readNotification = null; if ($candidateInterviewNotifications->isNotEmpty()) { $jobTitle = $interview->job->title ?? null; $interviewCreatedAt = $interview->created_at; $matchingNotifications = $candidateInterviewNotifications->filter(function($userNotification) use ($jobTitle, $interviewCreatedAt) { if (!$userNotification->notification) { return false; } $notificationTitle = $userNotification->notification->title ?? ''; $notificationMessage = $userNotification->notification->message ?? ''; $notificationCreatedAt = $userNotification->created_at; $titleMatches = false; if ($jobTitle && preg_match('/- (.+)$/', $notificationTitle, $matches)) { $extractedJobTitle = trim($matches[1]); $titleMatches = ($extractedJobTitle === $jobTitle); } $messageMatches = false; if (!$titleMatches && $jobTitle) { if (preg_match('/poste "([^"]+)"/', $notificationMessage, $msgMatches)) { $extractedJobTitle = trim($msgMatches[1]); $messageMatches = ($extractedJobTitle === $jobTitle); } else { $messageMatches = str_contains($notificationMessage, $jobTitle); } } $timeMatches = abs($notificationCreatedAt->diffInMinutes($interviewCreatedAt)) <= 5; return ($titleMatches || $messageMatches) && $timeMatches; }); $readNotification = $matchingNotifications->where('is_read', true)->first(); } $interview->notification_read = $readNotification ? true : false; $interview->notification_read_at = $readNotification ? $readNotification->read_at : null; return $interview; }); $stats = [ 'total' => Interview::forRecruiter($user->id)->count(), 'programme' => Interview::forRecruiter($user->id)->withStatus('programme')->count(), 'confirme' => Interview::forRecruiter($user->id)->withStatus('confirme')->count(), 'en_attente' => Interview::forRecruiter($user->id)->withStatus('en_attente')->count(), 'termine' => Interview::forRecruiter($user->id)->withStatus('termine')->count(), 'annule' => Interview::forRecruiter($user->id)->withStatus('annule')->count(), ]; return view('dashboard.recruiter.interviews', compact('interviews', 'stats'));
    }

    /**
     * Show the form for creating a new interview.
     */
    public function create(Request $request)
    {
        $this->authorize('scanner-pass');
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
        $this->authorize('scanner-pass'); $request->validate([ 'application_id' => 'required|exists:applications,id', 'interview_date' => 'required|date|after_or_equal:today', 'start_time' => 'required|date_format:H:i', 'duration_minutes' => 'required|integer|min:15|max:480', 'type' => 'required|in:visioconference,presentiel,telephonique', 'location' => 'required|string|max:255', 'notes' => 'nullable|string|max:1000', 'meeting_link' => 'nullable|url|max:500', 'meeting_id' => 'nullable|string|max:100', 'meeting_password' => 'nullable|string|max:50', ]); $user = Auth::user(); $application = Application::whereHas('job', function($query) use ($user) { $query->where('recruiter_id', $user->id); })->findOrFail($request->application_id); $conflictExists = Interview::forRecruiter($user->id) ->where('interview_date', $request->interview_date) ->where('start_time', $request->start_time) ->where('status', '!=', 'annule') ->exists(); if ($conflictExists) { return back()->withErrors(['start_time' => 'Vous avez déjà un entretien programmé à cette heure.']); } $interview = Interview::create([ 'recruiter_id' => $user->id, 'candidate_id' => $application->candidate_id, 'job_id' => $application->job_id, 'application_id' => $application->id, 'interview_date' => $request->interview_date, 'start_time' => $request->start_time, 'duration_minutes' => $request->duration_minutes, 'type' => $request->type, 'location' => $request->location, 'notes' => $request->notes, 'meeting_link' => $request->meeting_link, 'meeting_id' => $request->meeting_id, 'meeting_password' => $request->meeting_password, 'status' => 'programme', ]); $interview->load(['candidate', 'job.company', 'application']); if (!$application->relationLoaded('job')) { $application->load('job.company'); } $this->sendInterviewNotification($interview, $application); return redirect()->route('recruiter.interviews') ->with('success', 'Entretien programmé avec succès.');
    }

    /**
     * Display the specified interview.
     */
    public function show(Interview $interview)
    {
        $this->authorize('scanner-pass');
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
        $this->authorize('scanner-pass');
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
        $this->authorize('scanner-pass'); if ($interview->recruiter_id !== Auth::id()) { abort(403, 'Unauthorized access to this interview.'); } $request->validate([ 'interview_date' => 'required|date|after_or_equal:today', 'start_time' => 'required|date_format:H:i', 'duration_minutes' => 'required|integer|min:15|max:480', 'type' => 'required|in:visioconference,presentiel,telephonique', 'location' => 'required|string|max:255', 'notes' => 'nullable|string|max:1000', 'meeting_link' => 'nullable|url|max:500', 'meeting_id' => 'nullable|string|max:100', 'meeting_password' => 'nullable|string|max:50', ]); $conflictExists = Interview::forRecruiter(Auth::id()) ->where('interview_date', $request->interview_date) ->where('start_time', $request->start_time) ->where('status', '!=', 'annule') ->where('id', '!=', $interview->id) ->exists(); if ($conflictExists) { return back()->withErrors(['start_time' => 'Vous avez déjà un entretien programmé à cette heure.']); } $oldStatus = $interview->status; $interview->update($request->only([ 'interview_date', 'start_time', 'duration_minutes', 'type', 'location', 'notes', 'meeting_link', 'meeting_id', 'meeting_password', ])); $interview->load(['candidate', 'job.company', 'application']); $this->sendInterviewUpdateNotification($interview); return redirect()->route('recruiter.interviews') ->with('success', 'Entretien mis à jour avec succès.');
    }

    /**
     * Update the status of the specified interview.
     */
    public function updateStatus(Request $request, Interview $interview)
    {
        $this->authorize('scanner-pass'); if ($interview->recruiter_id !== Auth::id()) { abort(403, 'Unauthorized access to this interview.'); } $request->validate([ 'status' => 'required|in:programme,confirme,en_attente,annule,termine', ]); $oldStatus = $interview->status; $interview->update(['status' => $request->status]); $interview->load(['candidate', 'job.company', 'application']); $this->sendStatusChangeNotification($interview, $oldStatus, $request->status); $statusMap = [ 'programme' => 'Programmé', 'confirme' => 'Confirmé', 'en_attente' => 'En attente', 'annule' => 'Annulé', 'termine' => 'Terminé', ]; return back()->with('success', "Statut de l'entretien mis à jour: {$statusMap[$request->status]}");
    }

    /**
     * Remove the specified interview.
     */
    public function destroy(Interview $interview)
    {
        $this->authorize('scanner-pass');
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
        $this->authorize('scanner-pass');
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

        return api_json($interviews);
    }

    /**
     * Send interview notification to candidate
     */
    private function sendInterviewNotification($interview, $application)
    {
        $this->authorize('scanner-pass'); try { if (!$interview->relationLoaded('candidate')) { $interview->load('candidate'); } if (!$interview->relationLoaded('job')) { $interview->load('job'); } if (!$application->relationLoaded('job')) { $application->load('job'); } $notificationService = new NotificationService(); $interviewDate = $interview->interview_date->format('d/m/Y'); try { if ($interview->start_time instanceof \DateTime || $interview->start_time instanceof \Carbon\Carbon) { $interviewTime = $interview->start_time->format('H:i'); } else { $interviewTime = Carbon::parse($interview->start_time)->format('H:i'); } } catch (\Exception $e) { $interviewTime = is_string($interview->start_time) ? $interview->start_time : '00:00'; } $duration = $interview->duration_minutes; $typeInFrench = match($interview->type) { 'visioconference' => 'Visioconférence', 'presentiel' => 'Présentiel', 'telephonique' => 'Téléphonique', default => $interview->type }; $title = "Nouvel entretien programmé - {$application->job->title}"; $companyName = $application->job->company->name ?? 'l\'entreprise'; $message = "Un entretien a été programmé pour le poste \"{$application->job->title}\" chez {$companyName}. Consultez les détails ci-dessous."; $notification = $notificationService->createNotification( $title, $message, 'interview', [$interview->candidate_id] ); \Log::info('Interview notification sent successfully. Notification ID: ' . $notification->id); } catch (\Exception $e) { \Log::error('Failed to send interview notification: ' . $e->getMessage()); \Log::error('Stack trace: ' . $e->getTraceAsString()); }
    }

    /**
     * Send interview update notification to candidate
     */
    private function sendInterviewUpdateNotification($interview)
    {
        $this->authorize('scanner-pass'); try { if (!$interview->relationLoaded('candidate')) { $interview->load('candidate'); } if (!$interview->relationLoaded('job')) { $interview->load('job.company'); } $notificationService = new NotificationService(); $title = "Mise à jour de votre entretien - {$interview->job->title}"; $companyName = $interview->job->company->name ?? 'l\'entreprise'; $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} a été mis à jour. Consultez les détails ci-dessous."; $notification = $notificationService->createNotification( $title, $message, 'interview_update', [$interview->candidate_id] ); \Log::info('Interview update notification sent successfully. Notification ID: ' . $notification->id); } catch (\Exception $e) { \Log::error('Failed to send interview update notification: ' . $e->getMessage()); \Log::error('Stack trace: ' . $e->getTraceAsString()); }
    }

    /**
     * Send interview deletion notification to candidate
     */
    private function sendInterviewDeletionNotification($interview)
    {
        $this->authorize('scanner-pass'); try { if (!$interview->relationLoaded('candidate')) { $interview->load('candidate'); } if (!$interview->relationLoaded('job')) { $interview->load('job.company'); } $notificationService = new NotificationService(); $title = "Entretien annulé - {$interview->job->title}"; $companyName = $interview->job->company->name ?? 'l\'entreprise'; $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} a été annulé."; $notification = $notificationService->createNotification( $title, $message, 'interview_update', [$interview->candidate_id] ); \Log::info('Interview deletion notification sent successfully. Notification ID: ' . $notification->id); } catch (\Exception $e) { \Log::error('Failed to send interview deletion notification: ' . $e->getMessage()); \Log::error('Stack trace: ' . $e->getTraceAsString()); }
    }

    /**
     * Send status change notification to candidate
     */
    private function sendStatusChangeNotification($interview, $oldStatus, $newStatus)
    {
        $this->authorize('scanner-pass'); try { if (!$interview->relationLoaded('candidate')) { $interview->load('candidate'); } if (!$interview->relationLoaded('job')) { $interview->load('job.company'); } $notificationService = new NotificationService(); $statusMap = [ 'programme' => 'Programmé', 'confirme' => 'Confirmé', 'en_attente' => 'En attente', 'annule' => 'Annulé', 'termine' => 'Terminé', ]; $title = "Mise à jour de votre entretien - {$interview->job->title}"; $companyName = $interview->job->company->name ?? 'l\'entreprise'; switch ($newStatus) { case 'confirme': $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} a été confirmé. Consultez les détails ci-dessous."; break; case 'annule': $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} a été annulé. Consultez les détails ci-dessous."; break; case 'termine': $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} est terminé. Merci pour votre participation !"; break; case 'en_attente': $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} est en attente de confirmation. Consultez les détails ci-dessous."; break; default: $message = "Votre entretien pour le poste \"{$interview->job->title}\" chez {$companyName} a été mis à jour. Consultez les détails ci-dessous."; break; } $notificationService->createNotification( $title, $message, 'interview_update', [$interview->candidate_id] ); } catch (\Exception $e) { }
    }
}
