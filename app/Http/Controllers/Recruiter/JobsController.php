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

    public function applications(Job $job)
    {
        // Check if the job belongs to the authenticated recruiter
        if ($job->recruiter_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this job.');
        }

        // Load job with applications and candidate profiles
        $job->load(['applications.candidate.candidateProfile', 'company']);
        
        // Get applications with pagination
        $applications = $job->applications()
            ->with(['candidate.candidateProfile'])
            ->orderBy('applied_at', 'desc')
            ->paginate(10);

        // Calculate statistics
        $stats = [
            'total' => $job->applications()->count(),
            'pending' => $job->applications()->where('status', 'pending')->count(),
            'accepted' => $job->applications()->where('status', 'accepted')->count(),
            'rejected' => $job->applications()->where('status', 'rejected')->count(),
        ];

        return view('dashboard.recruiter.job-applications', compact('job', 'applications', 'stats'));
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