<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Application;
use App\Models\Company;
use App\Models\Interview;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.user.type:recruiter');
    }

    public function index()
    {
        $this->authorize('scanner-pass'); $user = Auth::user(); $recruiterProfile = $user->recruiterProfile; $company = $recruiterProfile ? $recruiterProfile->company : null; $jobs = $recruiterProfile && $recruiterProfile->company ? Job::where('recruiter_id', $user->id)->orderBy('created_at', 'desc')->get() : collect(); $applications = $jobs->isNotEmpty() ? Application::whereIn('job_id', $jobs->pluck('id'))->with(['candidate', 'job'])->get() : collect(); $upcomingInterviews = Interview::where('recruiter_id', $user->id) ->where('interview_date', '>=', now()->startOfDay()) ->whereIn('status', ['programme', 'confirme', 'en_attente']) ->with(['candidate', 'job', 'application']) ->orderBy('interview_date') ->orderBy('start_time') ->get(); $stats = [ 'active_jobs' => $jobs->where('status', 'published')->count(), 'total_applications' => $applications->count(), 'recent_applications' => $applications->where('created_at', '>=', now()->subDays(7))->count(), 'scheduled_interviews' => $upcomingInterviews->count(), 'profiles_viewed' => $applications->count() * 2, 'pending_applications' => $applications->where('status', 'pending')->count(), 'accepted_applications' => $applications->where('status', 'accepted')->count(), 'rejected_applications' => $applications->where('status', 'rejected')->count(), ]; $recentApplications = $applications->sortByDesc('created_at')->take(5); $activeJobs = $jobs->where('status', 'published')->sortByDesc('created_at')->take(3); return view('dashboard.recruiter.index', compact( 'stats', 'recentApplications', 'activeJobs', 'upcomingInterviews', 'company' ));
    }
}