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
        $user = Auth::user();
        
        // Get candidate profile
        $profile = $user->candidateProfile;
        
        // Get applications statistics
        $applications = $user->applications()->with(['job.company'])->get();
        $applicationsCount = $applications->count();
        $pendingApplications = $applications->where('status', 'pending')->count();
        $reviewedApplications = $applications->where('status', 'reviewed')->count();
        $shortlistedApplications = $applications->where('status', 'shortlisted')->count();
        
        // Get recent applications (last 5)
        $recentApplications = $user->applications()
            ->with(['job.company'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Get recommended jobs (jobs in same location or with similar skills)
        $recommendedJobs = collect();
        
        if ($profile) {
            // Get jobs in the same city
            if ($profile->city) {
                $locationJobs = \App\Models\Job::published()
                    ->active()
                    ->where('location', 'like', '%' . $profile->city . '%')
                    ->whereNotIn('id', $user->applications()->pluck('job_id'))
                    ->limit(3)
                    ->get();
                $recommendedJobs = $recommendedJobs->merge($locationJobs);
            }
            
            // Get jobs with similar skills/industry
            if ($profile->skills) {
                $skillsJobs = \App\Models\Job::published()
                    ->active()
                    ->where(function($query) use ($profile) {
                        foreach ($profile->skills as $skill) {
                            $query->orWhere('title', 'like', '%' . $skill . '%')
                                  ->orWhere('description', 'like', '%' . $skill . '%');
                        }
                    })
                    ->whereNotIn('id', $user->applications()->pluck('job_id'))
                    ->limit(3)
                    ->get();
                $recommendedJobs = $recommendedJobs->merge($skillsJobs);
            }
        }
        
        // If no recommendations based on profile, get recent published jobs
        if ($recommendedJobs->isEmpty()) {
            $recommendedJobs = \App\Models\Job::published()
                ->active()
                ->whereNotIn('id', $user->applications()->pluck('job_id'))
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();
        }
        
        // Remove duplicates and limit to 6
        $recommendedJobs = $recommendedJobs->unique('id')->take(6);
        
        // Get profile completion percentage
        $profileCompletion = $profile ? $profile->getCompletionPercentage() : 0;
        
        // Get upcoming interviews (not cancelled or completed)
        $upcomingInterviews = Interview::where('candidate_id', $user->id)
            ->whereNotIn('status', ['annule', 'termine'])
            ->where('interview_date', '>=', now()->toDateString())
            ->with(['job.company', 'recruiter'])
            ->orderBy('interview_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->limit(5)
            ->get();

        // Statistics for dashboard
        $stats = [
            'total_applications' => $applicationsCount,
            'pending_applications' => $pendingApplications,
            'reviewed_applications' => $reviewedApplications,
            'shortlisted_applications' => $shortlistedApplications,
            'success_rate' => $applicationsCount > 0 ? round(($shortlistedApplications / $applicationsCount) * 100, 1) : 0,
            'profile_completion' => $profileCompletion,
        ];
        
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
}