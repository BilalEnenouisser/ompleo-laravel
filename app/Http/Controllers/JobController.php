<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('status', 'published')
            ->with('company')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        $job->load('company');
        
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