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
                  ->orWhere('experience', 'like', "%{$search}%")
                  ->orWhere('experience_level', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%")
                  ->orWhere('work_type', 'like', "%{$search}%")
                  ->orWhereHas('company', function($companyQuery) use ($search) {
                      $companyQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('industry', 'like', "%{$search}%");
                  });
            });
        }

        // Company filter
        if ($request->filled('company')) {
            $query->where('company_id', $request->company);
        }

        // Location filter
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Contract Type filter (CDI, Stage, etc.)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Work Mode filter (remote, onsite, hybrid)
        if ($request->filled('work_type')) {
            $query->where('work_type', $request->work_type);
        }

        // Category / Tags filter
        if ($request->filled('category')) {
            $query->whereJsonContains('tags', $request->category);
        }

        // Experience level filter
        if ($request->filled('experience')) {
            $query->where(function($q) use ($request) {
                $q->where('experience_level', 'like', "%{$request->experience}%")
                  ->orWhere('experience', 'like', "%{$request->experience}%");
            });
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

        // Check if it's an AJAX request for "show more" functionality
        if ($request->ajax() || $request->has('page')) {
            $page = $request->get('page', 2); // AJAX requests start from page 2
            $perPage = 5; // Load 5 more jobs per AJAX request
            
            // Calculate offset: (page - 1) * perPage + 10 (since first 10 are already shown)
            $offset = ($page - 2) * $perPage + 10;
            
            $jobs = $query->skip($offset)->take($perPage)->get();
            $totalJobs = $query->count();
            $hasMore = ($offset + $perPage) < $totalJobs;
            
            return response()->json([
                'html' => view('jobs.partials.job-card', ['jobs' => $jobs])->render(),
                'hasMore' => $hasMore,
                'nextPage' => $page + 1
            ]);
        }
        
        // For the new layout tabs
        $tab = $request->get('tab', 'all');
        
        // Gather unique locations
        $locations = Job::where('status', 'published')
            ->whereNotNull('location')
            ->distinct()
            ->pluck('location')
            ->sort()
            ->values();

        // Gather unique categories from tags
        $categories = Job::where('status', 'published')
            ->whereNotNull('tags')
            ->get()
            ->pluck('tags')
            ->flatten()
            ->unique()
            ->values()
            ->sort()
            ->values();
            
        // Fallback categories if none found in tags
        if ($categories->isEmpty()) {
            $categories = collect(['Design', 'Développement', 'Informatique', 'Marketing', 'Finance', 'Ventes', 'Ressources Humaines', 'Support']);
        }

        // Gather unique contract types (CDI, Stage, etc.)
        $types = Job::where('status', 'published')
            ->whereNotNull('type')
            ->distinct()
            ->pluck('type')
            ->sort()
            ->values();
            
        // Fallback if none found
        if ($types->isEmpty()) {
            $types = collect(['CDI', 'CDD', 'Stage', 'Freelance', 'Alternance']);
        }

        // Initial load - show first 10 jobs
        $jobs = $query->paginate(10);
        
        // Get total count of published jobs for the hero section
        $totalPublishedJobs = Job::where('status', 'published')->count();
            
        return view('jobs.index', compact('jobs', 'totalPublishedJobs', 'tab', 'locations', 'categories', 'types'));
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
        
        // Get last 4 recent jobs
        $recentJobs = Job::where('status', 'published')
            ->where('id', '!=', $job->id)
            ->latest()
            ->with('company')
            ->limit(4)
            ->get();
        
        // Check if user has already applied to this job
        $existingApplication = null;
        if (auth()->check() && auth()->user()->isCandidate()) {
            $existingApplication = \App\Models\Application::where('job_id', $job->id)
                ->where('candidate_id', auth()->id())
                ->first();
        }
        
        return view('jobs.show', compact('job', 'relatedJobs', 'existingApplication', 'recentJobs'));
    }

    public function searchApi(Request $request)
    {
        $search = $request->get('q');
        
        if (empty($search)) {
            return response()->json(['jobs' => []]);
        }
        
        $jobs = Job::where('status', 'published')
            ->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('company', function($companyQuery) use ($search) {
                      $companyQuery->where('name', 'like', "%{$search}%");
                  });
            })
            ->with('company')
            ->limit(6)
            ->get()
            ->map(function($job) {
                return [
                    'id' => $job->id,
                    'title' => $job->title,
                    'company_name' => $job->company ? $job->company->name : 'N/A',
                    'slug' => $job->slug,
                    'url' => route('jobs.show', $job->slug),
                ];
            });
            
        return response()->json(['jobs' => $jobs]);
    }
}