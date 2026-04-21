<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->user_type !== 'candidate') {
                abort(403, 'Accès non autorisé');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $this->authorize('scanner-pass');
        $user = Auth::user();
        $profile = $user->candidateProfile;
        $applications = $user->applications()->with(['job.company'])->get();
        $recentApplications = $this->getRecentApplications($user);
        $recommendedJobs = $this->getRecommendedJobs($user, $profile);
        $upcomingInterviews = $this->getUpcomingInterviews((int) $user->id);
        $stats = $this->buildDashboardStats($applications, $profile);
        
        return view('dashboard.candidate.index', compact(
            'user', 
            'profile', 
            'applications', 
            'recentApplications', 
            'recommendedJobs', 
            'stats',
            'upcomingInterviews'
        ));
    }

    private function getRecentApplications($user)
    {
        return $user->applications()
            ->with(['job.company'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    private function getRecommendedJobs($user, $profile)
    {
        $excludedJobIds = $user->applications()->pluck('job_id'); $recommendedJobs = collect(); if ($profile && $profile->city) { $recommendedJobs = $recommendedJobs->merge( \App\Models\Job::published() ->active() ->where('location', 'like', '%' . $profile->city . '%') ->whereNotIn('id', $excludedJobIds) ->limit(3) ->get() ); } if ($profile && $profile->skills) { $recommendedJobs = $recommendedJobs->merge( \App\Models\Job::published() ->active() ->where(function ($query) use ($profile) { foreach ($profile->skills as $skill) { $query->orWhere('title', 'like', '%' . $skill . '%') ->orWhere('description', 'like', '%' . $skill . '%'); } }) ->whereNotIn('id', $excludedJobIds) ->limit(3) ->get() ); } if ($recommendedJobs->isEmpty()) { $recommendedJobs = \App\Models\Job::published() ->active() ->whereNotIn('id', $excludedJobIds) ->orderBy('created_at', 'desc') ->limit(6) ->get(); } return $recommendedJobs->unique('id')->take(6);
    }

    private function getUpcomingInterviews(int $candidateId)
    {
        return Interview::where('candidate_id', $candidateId)
            ->whereNotIn('status', ['annule', 'termine'])
            ->where('interview_date', '>=', now()->toDateString())
            ->with(['job.company', 'recruiter'])
            ->orderBy('interview_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->limit(5)
            ->get();
    }

    private function buildDashboardStats($applications, $profile): array
    {
        $applicationsCount = $applications->count();
        $shortlistedApplications = $applications->where('status', 'shortlisted')->count();

        return [
            'total_applications' => $applicationsCount,
            'pending_applications' => $applications->where('status', 'pending')->count(),
            'reviewed_applications' => $applications->where('status', 'reviewed')->count(),
            'shortlisted_applications' => $shortlistedApplications,
            'success_rate' => $applicationsCount > 0 ? round(($shortlistedApplications / $applicationsCount) * 100, 1) : 0,
            'profile_completion' => $profile ? $profile->getCompletionPercentage() : 0,
        ];
    }
}