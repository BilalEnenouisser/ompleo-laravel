<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.user.type:recruiter');
    }

    public function index()
    {
        $user = Auth::user();
        $recruiterProfile = $user->recruiterProfile;
        
        // Get recruiter's jobs
        $jobs = $recruiterProfile && $recruiterProfile->company 
            ? Job::where('recruiter_id', $user->id)->with(['company', 'applications'])->get()
            : collect();
        
        // Calculate statistics
        $totalJobs = $jobs->count();
        $activeJobs = $jobs->where('status', 'published')->count();
        $expiredJobs = $jobs->where('status', 'expired')->count();
        $draftJobs = $jobs->where('status', 'draft')->count();
        
        return view('dashboard.recruiter.jobs', compact('jobs', 'totalJobs', 'activeJobs', 'expiredJobs', 'draftJobs'));
    }

    public function show(Job $job)
    {
        // Check if the job belongs to the authenticated recruiter
        if ($job->recruiter_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this job.');
        }

        $job->load(['company', 'applications']);
        
        return view('dashboard.recruiter.job-detail', compact('job'));
    }

    public function destroy(Job $job)
    {
        // Check if the job belongs to the authenticated recruiter
        if ($job->recruiter_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this job.');
        }

        $job->delete();

        return redirect()->route('recruiter.jobs')->with('success', 'Offre d\'emploi supprimée avec succès!');
    }
}