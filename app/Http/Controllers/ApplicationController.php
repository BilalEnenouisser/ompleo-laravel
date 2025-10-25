<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;
use App\Services\FileUploadService;
use App\Services\NotificationService;
use App\Http\Requests\StoreApplicationRequest;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    protected $fileUploadService;
    protected $notificationService;

    public function __construct(FileUploadService $fileUploadService, NotificationService $notificationService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->notificationService = $notificationService;
    }

    /**
     * Display a listing of applications for the authenticated user
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isCandidate()) {
            $applications = $user->applications()->with(['job.company'])->orderBy('applied_at', 'desc')->paginate(10);
            
            // Calculate statistics for candidate
            $stats = [
                'total' => $user->applications()->count(),
                'pending' => $user->applications()->where('status', 'pending')->count(),
                'accepted' => $user->applications()->where('status', 'accepted')->count(),
                'rejected' => $user->applications()->where('status', 'rejected')->count(),
            ];
            
            return view('dashboard.candidate.applications', compact('applications', 'stats'));
        } elseif ($user->isRecruiter()) {
            $applications = Application::whereHas('job', function($query) use ($user) {
                $query->where('recruiter_id', $user->id);
            })->with(['job.company', 'candidate'])->paginate(10);
        } else {
            $applications = Application::with(['job.company', 'candidate'])->paginate(10);
        }

        return view('applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new application
     */
    public function create(Job $job)
    {
        // Check if user already applied
        $existingApplication = Application::where('job_id', $job->id)
            ->where('candidate_id', Auth::id())
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'Vous avez déjà postulé à cette offre.');
        }

        return view('applications.create', compact('job'));
    }

    /**
     * Store a newly created application
     */
    public function store(StoreApplicationRequest $request)
    {
        $user = Auth::user();
        
        if (!$user->isCandidate()) {
            return redirect()->back()->with('error', 'Seuls les candidats peuvent postuler.');
        }

        try {
            // Upload resume if provided
            $resumePath = null;
            if ($request->hasFile('resume')) {
                $resumePath = $this->fileUploadService->uploadResume($request->file('resume'));
            }

            // Create application
            $application = Application::create([
                'job_id' => $request->job_id,
                'candidate_id' => $user->id,
                'cover_letter' => $request->cover_letter,
                'resume_path' => $resumePath,
                'status' => 'pending',
                'applied_at' => now(),
            ]);

            // Load relationships for notification
            $application->load(['job.company', 'job.recruiter', 'candidate']);

            // Send notification to recruiter
            try {
                \Log::info('Attempting to send notification for application: ' . $application->id);
                $this->notificationService->notifyApplicationReceived($application);
                \Log::info('Notification sent successfully for application: ' . $application->id);
            } catch (\Exception $e) {
                // Log the error but don't fail the application
                \Log::error('Failed to send application notification: ' . $e->getMessage());
                \Log::error('Stack trace: ' . $e->getTraceAsString());
            }

            return redirect()->route('jobs.show', $application->job->slug)
                ->with('success', 'Votre candidature a été envoyée avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de l\'envoi de la candidature: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified application
     */
    public function show(Application $application)
    {
        $user = Auth::user();
        
        // Check if user can view this application
        if ($user->isCandidate() && $application->candidate_id !== $user->id) {
            abort(403, 'Access denied.');
        }
        
        if ($user->isRecruiter() && $application->job->recruiter_id !== $user->id) {
            abort(403, 'Access denied.');
        }

        $application->load(['job.company', 'candidate']);

        return view('applications.show', compact('application'));
    }

    /**
     * Update application status (for recruiters)
     */
    public function updateStatus(Request $request, Application $application)
    {
        $user = Auth::user();
        
        if (!$user->isRecruiter() && !$user->isAdmin()) {
            abort(403, 'Access denied.');
        }

        $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,rejected,accepted'
        ]);

        try {
            $oldStatus = $application->status;
            $application->updateStatus($request->status);
            
            // Load relationships for notification
            $application->load(['job.company', 'candidate']);

            // Send notification to candidate if status changed
            if ($oldStatus !== $request->status && in_array($request->status, ['accepted', 'rejected', 'shortlisted'])) {
                try {
                    \Log::info('Sending status update notification for application: ' . $application->id . ' to candidate: ' . $application->candidate_id . ' with status: ' . $request->status);
                    $this->notificationService->notifyApplicationStatusUpdate($application, $request->status);
                    \Log::info('Status update notification sent successfully');
                } catch (\Exception $e) {
                    \Log::error('Failed to send status update notification: ' . $e->getMessage());
                    \Log::error('Stack trace: ' . $e->getTraceAsString());
                }
            }

            return redirect()->back()
                ->with('success', 'Statut de la candidature mis à jour.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
        }
    }

    /**
     * Withdraw application (for candidates)
     */
    public function withdraw(Application $application)
    {
        $user = Auth::user();
        
        if (!$user->isCandidate() || $application->candidate_id !== $user->id) {
            abort(403, 'Access denied.');
        }

        $application->delete();

        return redirect()->route('applications.index')
            ->with('success', 'Candidature retirée avec succès.');
    }
}
