<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
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
        $this->authorize('scanner-pass');
        $this->fileUploadService = $fileUploadService;
        $this->notificationService = $notificationService;
    }

    /**
     * Display a listing of applications
     */
    public function index(Request $request)
    {
        $this->authorize('scanner-pass');
        $this->authorize('viewAny', Application::class);
        $user = Auth::user();

        if ($user->isCandidate()) {
            $applications = $user->applications()
                ->with(['job.company'])
                ->orderBy('applied_at', 'desc')
                ->paginate($request->get('per_page', 10));
        } elseif ($user->isRecruiter()) {
            $applications = Application::whereHas('job', function ($query) use ($user) {
                $query->where('recruiter_id', $user->id);
            })->with(['job.company', 'candidate'])
                ->orderBy('applied_at', 'desc')
                ->paginate($request->get('per_page', 10));
        } else {
            $applications = Application::with(['job.company', 'candidate'])
                ->orderBy('applied_at', 'desc')
                ->paginate($request->get('per_page', 10));
        }

        return ApplicationResource::collection($applications)
            ->additional([
                'success' => true,
                'message' => 'Applications retrieved successfully',
            ]);
    }

    /**
     * Store a newly created application
     */
    public function store(StoreApplicationRequest $request)
    {
        $this->authorize('scanner-pass'); $this->authorize('create', Application::class); $user = Auth::user(); try { $existingApplication = Application::where('job_id', $request->job_id) ->where('candidate_id', $user->id) ->first(); if ($existingApplication) { return api_json([ 'success' => false, 'message' => 'You have already applied for this job' ], 400); } $resumePath = null; if ($request->hasFile('resume')) { $resumePath = $this->fileUploadService->uploadResume($request->file('resume')); } $application = Application::create([ 'job_id' => $request->job_id, 'candidate_id' => $user->id, 'cover_letter' => $request->cover_letter, 'resume_path' => $resumePath, 'status' => 'pending', 'applied_at' => now(), ]); $application->load(['job.company', 'job.recruiter', 'candidate']); try { $this->notificationService->notifyApplicationReceived($application); } catch (\Exception $e) { } return (new ApplicationResource($application)) ->additional([ 'success' => true, 'message' => 'Application submitted successfully', ]) ->response() ->setStatusCode(201); } catch (\Exception $e) { return api_json([ 'success' => false, 'message' => 'Error submitting application: ' . $e->getMessage() ], 500); }
    }

    /**
     * Display the specified application
     */
    public function show(Application $application)
    {
        $this->authorize('scanner-pass');
        $this->authorize('view', $application);

        $application->load(['job.company', 'candidate']);

        return (new ApplicationResource($application))
            ->additional([
                'success' => true,
                'message' => 'Application retrieved successfully',
            ]);
    }

    /**
     * Update application status (for recruiters)
     */
    public function updateStatus(Request $request, Application $application)
    {
        $this->authorize('scanner-pass');
        $this->authorize('update', $application);

        $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,rejected,accepted'
        ]);

        $application->updateStatus($request->status);
        $application->load(['job.company', 'candidate']);

        return (new ApplicationResource($application))
            ->additional([
                'success' => true,
                'message' => 'Application status updated successfully',
            ]);
    }

    /**
     * Remove the specified application
     */
    public function destroy(Application $application)
    {
        $this->authorize('scanner-pass');
        $this->authorize('withdraw', $application);

        $application->delete();

        return api_json([
            'success' => true,
            'message' => 'Application withdrawn successfully'
        ]);
    }
}
