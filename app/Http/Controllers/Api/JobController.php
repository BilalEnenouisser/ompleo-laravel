<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $query = Job::where('status', 'published')
            ->with(['company', 'recruiter']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhereHas('company', function($companyQuery) use ($search) {
                      $companyQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filters
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('experience')) {
            $query->where('experience_level', 'like', "%{$request->experience}%");
        }

        if ($request->filled('salary_min')) {
            $query->where('salary_min', '>=', $request->salary_min);
        }

        if ($request->filled('salary_max')) {
            $query->where('salary_max', '<=', $request->salary_max);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'salary_asc':
                $query->orderBy('salary_min', 'asc');
                break;
            case 'salary_desc':
                $query->orderBy('salary_max', 'desc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $jobs = $query->paginate($request->get('per_page', 12));

        return response()->json([
            'success' => true,
            'data' => $jobs,
            'message' => 'Jobs retrieved successfully'
        ]);
    }

    /**
     * Display the specified job (Public API)
     */
    public function show(Job $job)
    {
        if ($job->status !== 'published') {
            return response()->json([
                'success' => false,
                'message' => 'Job not found'
            ], 404);
        }

        $job->load(['company', 'recruiter']);
        
        // Increment view count
        $job->incrementViews();

        return response()->json([
            'success' => true,
            'data' => $job,
            'message' => 'Job retrieved successfully'
        ]);
    }

    /**
     * Store a newly created job (Protected API)
     */
    public function store(StoreJobRequest $request)
    {
        $user = Auth::user();
        
        $job = Job::create([
            'company_id' => $request->company_id,
            'recruiter_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'type' => $request->type,
            'work_type' => $request->work_type,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'experience_level' => $request->experience_level,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'tags' => $request->tags,
            'application_deadline' => $request->application_deadline,
            'is_featured' => $request->is_featured ?? false,
            'status' => 'published'
        ]);

        $job->load(['company', 'recruiter']);

        return response()->json([
            'success' => true,
            'data' => $job,
            'message' => 'Job created successfully'
        ], 201);
    }

    /**
     * Update the specified job (Protected API)
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        $user = Auth::user();
        
        // Check if user can update this job
        if (!$user->isAdmin() && $job->recruiter_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to update this job'
            ], 403);
        }

        $job->update($request->validated());
        $job->load(['company', 'recruiter']);

        return response()->json([
            'success' => true,
            'data' => $job,
            'message' => 'Job updated successfully'
        ]);
    }

    /**
     * Remove the specified job (Protected API)
     */
    public function destroy(Job $job)
    {
        $user = Auth::user();
        
        // Check if user can delete this job
        if (!$user->isAdmin() && $job->recruiter_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to delete this job'
            ], 403);
        }

        $job->delete();

        return response()->json([
            'success' => true,
            'message' => 'Job deleted successfully'
        ]);
    }

    /**
     * Update job status (Protected API)
     */
    public function updateStatus(Request $request, Job $job)
    {
        $user = Auth::user();
        
        // Check if user can update this job
        if (!$user->isAdmin() && $job->recruiter_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to update this job'
            ], 403);
        }

        $request->validate([
            'status' => 'required|in:draft,published,closed'
        ]);

        $job->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'data' => $job,
            'message' => 'Job status updated successfully'
        ]);
    }
}
