<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Http\Requests\StoreApplicationRequest;
use App\Services\FileUploadService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
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
     * Display a listing of applications
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($user->isCandidate()) {
            $applications = $user->applications()
                ->with(['job.company'])
                ->orderBy('applied_at', 'desc')
                ->paginate($request->get('per_page', 10));
        } elseif ($user->isRecruiter()) {
            $applications = Application::whereHas('job', function($query) use ($user) {
                $query->where('recruiter_id', $user->id);
            })->with(['job.company', 'candidate'])
            ->orderBy('applied_at', 'desc')
            ->paginate($request->get('per_page', 10));
        } else {
            $applications = Application::with(['job.company', 'candidate'])
                ->orderBy('applied_at', 'desc')
                ->paginate($request->get('per_page', 10));
        }

        return response()->json([
            'success' => true,
            'data' => $applications,
            'message' => 'Applications retrieved successfully'
        ]);
    }

    /**
     * Store a newly created application
     */
    public function store(StoreApplicationRequest $request)
    {
        $user = Auth::user();
        
        if (!$user->isCandidate()) {
            return response()->json([
                'success' => false,
                'message' => 'Only candidates can apply for jobs'
            ], 403);
        }

        try {
            // Check if user already applied
            $existingApplication = Application::where('job_id', $request->job_id)
                ->where('candidate_id', $user->id)
                ->first();

            if ($existingApplication) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already applied for this job'
                ], 400);
            }

            // Upload resume
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

            $application->load(['job.company', 'job.recruiter', 'candidate']);

            // Send notification to recruiter
            try {
                $this->notificationService->notifyApplicationReceived($application);
            } catch (\Exception $e) {
            }

            return response()->json([
                'success' => true,
                'data' => $application,
                'message' => 'Application submitted successfully'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error submitting application: ' . $e->getMessage()
            ], 500);
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
            return response()->json([
                'success' => false,
                'message' => 'Access denied'
            ], 403);
        }
        
        if ($user->isRecruiter() && $application->job->recruiter_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Access denied'
            ], 403);
        }

        $application->load(['job.company', 'candidate']);

        return response()->json([
            'success' => true,
            'data' => $application,
            'message' => 'Application retrieved successfully'
        ]);
    }

    /**
     * Update application status (for recruiters)
     */
    public function updateStatus(Request $request, Application $application)
    {
        $user = Auth::user();
        
        if (!$user->isRecruiter() && !$user->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Access denied'
            ], 403);
        }

        // Check if recruiter can update this application
        if ($user->isRecruiter() && $application->job->recruiter_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Access denied'
            ], 403);
        }

        $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,rejected,accepted'
        ]);

        $application->updateStatus($request->status);

        return response()->json([
            'success' => true,
            'data' => $application,
            'message' => 'Application status updated successfully'
        ]);
    }

    /**
     * Remove the specified application
     */
    public function destroy(Application $application)
    {
        $user = Auth::user();
        
        if (!$user->isCandidate() || $application->candidate_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Access denied'
            ], 403);
        }

        $application->delete();

        return response()->json([
            'success' => true,
            'message' => 'Application withdrawn successfully'
        ]);
    }
}
