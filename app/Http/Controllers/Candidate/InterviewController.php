<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->user_type !== 'candidate') {
                abort(403, 'Accès non autorisé');
            }
            return $next($request);
        });
        $this->notificationService = $notificationService;
    }

    /**
     * Display the specified interview for candidate
     */
    public function show(Interview $interview)
    {
        $user = Auth::user();
        
        // Check if the interview belongs to the authenticated candidate
        if ($interview->candidate_id !== $user->id) {
            abort(403, 'Accès non autorisé à cet entretien.');
        }

        $interview->load(['recruiter', 'job.company', 'application']);

        return view('dashboard.candidate.interview-detail', compact('interview'));
    }

    /**
     * Confirm the interview
     */
    public function confirm(Request $request, Interview $interview)
    {
        $user = Auth::user();
        
        // Check if the interview belongs to the authenticated candidate
        if ($interview->candidate_id !== $user->id) {
            abort(403, 'Accès non autorisé à cet entretien.');
        }

        $interview->update(['status' => 'confirme']);
        $interview->load(['recruiter', 'job.company']);

        // Send notification to recruiter
        $this->notificationService->notifyInterviewConfirmed($interview);

        return redirect()->back()->with('success', 'Entretien confirmé avec succès.');
    }

    /**
     * Cancel the interview
     */
    public function cancel(Request $request, Interview $interview)
    {
        $user = Auth::user();
        
        // Check if the interview belongs to the authenticated candidate
        if ($interview->candidate_id !== $user->id) {
            abort(403, 'Accès non autorisé à cet entretien.');
        }

        $request->validate([
            'cancellation_reason' => 'required|string|max:500',
        ]);

        $interview->update([
            'status' => 'annule',
            'notes' => ($interview->notes ?? '') . "\n\n[Annulé par candidat] " . $request->cancellation_reason,
        ]);
        $interview->load(['recruiter', 'job.company']);

        // Send notification to recruiter
        $this->notificationService->notifyInterviewCancelledByCandidate($interview, $request->cancellation_reason);

        return redirect()->back()->with('success', 'Entretien annulé. Le recruteur a été notifié.');
    }

    /**
     * Request change to the interview
     */
    public function requestChange(Request $request, Interview $interview)
    {
        $user = Auth::user();
        
        // Check if the interview belongs to the authenticated candidate
        if ($interview->candidate_id !== $user->id) {
            abort(403, 'Accès non autorisé à cet entretien.');
        }

        $request->validate([
            'change_request' => 'required|string|max:500',
            'suggested_date' => 'nullable|date|after_or_equal:today',
            'suggested_time' => 'nullable|date_format:H:i',
        ]);

        $interview->load(['recruiter', 'job.company']);

        // Send notification to recruiter
        $this->notificationService->notifyInterviewChangeRequest($interview, $request->change_request, $request->suggested_date, $request->suggested_time);

        return redirect()->back()->with('success', 'Demande de modification envoyée au recruteur.');
    }

    /**
     * Report a problem with the interview
     */
    public function reportProblem(Request $request, Interview $interview)
    {
        $user = Auth::user();
        
        // Check if the interview belongs to the authenticated candidate
        if ($interview->candidate_id !== $user->id) {
            abort(403, 'Accès non autorisé à cet entretien.');
        }

        $request->validate([
            'problem_description' => 'required|string|max:500',
        ]);

        $interview->load(['recruiter', 'job.company']);

        // Send notification to recruiter
        $this->notificationService->notifyInterviewProblemReport($interview, $request->problem_description);

        return redirect()->back()->with('success', 'Problème signalé. Le recruteur a été notifié.');
    }
}

