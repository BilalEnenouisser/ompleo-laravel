<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Application;
use App\Models\Company;

class DashboardController extends Controller
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
        
        // Get company if exists
        $company = $recruiterProfile ? $recruiterProfile->company : null;
        
        // Get recruiter's jobs (newest first)
        $jobs = $recruiterProfile && $recruiterProfile->company 
            ? Job::where('recruiter_id', $user->id)->orderBy('created_at', 'desc')->get()
            : collect();
        
        // Get applications for recruiter's jobs
        $applications = $jobs->isNotEmpty() 
            ? Application::whereIn('job_id', $jobs->pluck('id'))->get()
            : collect();
        
        // Calculate statistics
        $stats = [
            'active_jobs' => $jobs->where('status', 'active')->count(),
            'total_applications' => $applications->count(),
            'recent_applications' => $applications->where('created_at', '>=', now()->subDays(7))->count(),
            'scheduled_interviews' => 0, // Placeholder for now
        ];
        
        // Get recent applications (last 5)
        $recentApplications = $applications->take(5);
        
        // Get active jobs (last 3)
        $activeJobs = $jobs->where('status', 'active')->take(3);
        
        return view('dashboard.recruiter.index', compact(
            'stats',
            'recentApplications', 
            'activeJobs',
            'company'
        ));
    }
}