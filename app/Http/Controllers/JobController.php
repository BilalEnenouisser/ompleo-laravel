<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::where('status', 'published')
            ->with('company');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhereHas('company', function($companyQuery) use ($search) {
                      $companyQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('industry', 'like', "%{$search}%");
                  });
            });
        }

        // Location filter
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Type filter
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Experience level filter
        if ($request->filled('experience')) {
            $query->where('experience_level', 'like', "%{$request->experience}%");
        }

        // Salary range filter
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

        $jobs = $query->paginate(12);
            
        return view('jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        $job->load('company');
        
        // Increment view count
        $job->incrementViews();
        
        // Get related jobs with smart matching
        $relatedJobs = collect();
        
        // 1. First priority: Same company jobs
        $sameCompanyJobs = Job::where('status', 'published')
            ->where('company_id', $job->company_id)
            ->where('id', '!=', $job->id)
            ->with('company')
            ->limit(2)
            ->get();
        
        $relatedJobs = $relatedJobs->merge($sameCompanyJobs);
        
        // 2. Second priority: Same job type
        if ($relatedJobs->count() < 3) {
            $sameTypeJobs = Job::where('status', 'published')
                ->where('type', $job->type)
                ->where('id', '!=', $job->id)
                ->whereNotIn('id', $relatedJobs->pluck('id'))
                ->with('company')
                ->limit(3 - $relatedJobs->count())
                ->get();
            
            $relatedJobs = $relatedJobs->merge($sameTypeJobs);
        }
        
        // 3. Third priority: Similar location
        if ($relatedJobs->count() < 3) {
            $location = explode(',', $job->location)[0]; // Get first part of location
            $similarLocationJobs = Job::where('status', 'published')
                ->where('location', 'like', '%' . $location . '%')
                ->where('id', '!=', $job->id)
                ->whereNotIn('id', $relatedJobs->pluck('id'))
                ->with('company')
                ->limit(3 - $relatedJobs->count())
                ->get();
            
            $relatedJobs = $relatedJobs->merge($similarLocationJobs);
        }
        
        // 4. Fallback: Any other published jobs
        if ($relatedJobs->count() < 3) {
            $otherJobs = Job::where('status', 'published')
                ->where('id', '!=', $job->id)
                ->whereNotIn('id', $relatedJobs->pluck('id'))
                ->with('company')
                ->limit(3 - $relatedJobs->count())
                ->get();
            
            $relatedJobs = $relatedJobs->merge($otherJobs);
        }
        
        // Limit to 3 jobs
        $relatedJobs = $relatedJobs->take(3);
        
        return view('jobs.show', compact('job', 'relatedJobs'));
    }
}