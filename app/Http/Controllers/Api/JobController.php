<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JobResource;
use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of jobs (Public API)
     */
    public function index(Request $request)
    {
        $query = Job::where('status', 'published') ->with(['company', 'recruiter']); if ($request->filled('search')) { $search = $request->search; $query->where(function($q) use ($search) { $q->where('title', 'like', "%{$search}%") ->orWhere('description', 'like', "%{$search}%") ->orWhere('location', 'like', "%{$search}%") ->orWhereHas('company', function($companyQuery) use ($search) { $companyQuery->where('name', 'like', "%{$search}%"); }); }); } if ($request->filled('location')) { $query->where('location', 'like', "%{$request->location}%"); } if ($request->filled('type')) { $query->where('type', $request->type); } if ($request->filled('experience')) { $query->where('experience_level', 'like', "%{$request->experience}%"); } if ($request->filled('salary_min')) { $query->where('salary_min', '>=', $request->salary_min); } if ($request->filled('salary_max')) { $query->where('salary_max', '<=', $request->salary_max); } $sort = $request->get('sort', 'newest'); switch ($sort) { case 'salary_asc': $query->orderBy('salary_min', 'asc'); break; case 'salary_desc': $query->orderBy('salary_max', 'desc'); break; case 'title': $query->orderBy('title', 'asc'); break; case 'newest': default: $query->orderBy('created_at', 'desc'); break; } $jobs = $query->paginate($request->get('per_page', 12)); return JobResource::collection($jobs) ->additional([ 'success' => true, 'message' => 'Jobs retrieved successfully', ]);
    }

    /**
     * Display the specified job (Public API)
     */
    public function show(Job $job)
    {
        if ($job->status !== 'published') {
            return api_json([
                'success' => false,
                'message' => 'Job not found'
            ], 404);
        }

        $job->load(['company', 'recruiter']);
        
        // Increment view count
        $job->incrementViews();

        return (new JobResource($job))
            ->additional([
                'success' => true,
                'message' => 'Job retrieved successfully',
            ]);
    }

    /**
     * Store a newly created job (Protected API)
     */
    public function store(StoreJobRequest $request)
    {
        $this->authorize('scanner-pass'); $user = Auth::user(); $this->authorize('create', Job::class); $job = Job::create([ 'company_id' => $request->company_id, 'recruiter_id' => $user->id, 'title' => $request->title, 'description' => $request->description, 'location' => $request->location, 'type' => $request->type, 'work_type' => $request->work_type, 'salary_min' => $request->salary_min, 'salary_max' => $request->salary_max, 'experience_level' => $request->experience_level, 'requirements' => $request->requirements, 'benefits' => $request->benefits, 'tags' => $request->tags, 'application_deadline' => $request->application_deadline, 'is_featured' => $request->is_featured ?? false, 'status' => 'published' ]); $job->load(['company', 'recruiter']); return (new JobResource($job)) ->additional([ 'success' => true, 'message' => 'Job created successfully', ]) ->response() ->setStatusCode(201);
    }

    /**
     * Update the specified job (Protected API)
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        $this->authorize('scanner-pass');
        $this->authorize('update', $job);

        $job->update($request->validated());
        $job->load(['company', 'recruiter']);

        return (new JobResource($job))
            ->additional([
                'success' => true,
                'message' => 'Job updated successfully',
            ]);
    }

    /**
     * Remove the specified job (Protected API)
     */
    public function destroy(Job $job)
    {
        $this->authorize('scanner-pass');
        $this->authorize('delete', $job);

        $job->delete();

        return api_json([
            'success' => true,
            'message' => 'Job deleted successfully'
        ]);
    }

    /**
     * Update job status (Protected API)
     */
    public function updateStatus(Request $request, Job $job)
    {
        $this->authorize('scanner-pass');
        $this->authorize('update', $job);

        $request->validate([
            'status' => 'required|in:draft,published,pending,expired,closed,suspended'
        ]);

        $job->update(['status' => $request->status]);

        $job->load(['company', 'recruiter']);

        return (new JobResource($job))
            ->additional([
                'success' => true,
                'message' => 'Job status updated successfully',
            ]);
    }
}
