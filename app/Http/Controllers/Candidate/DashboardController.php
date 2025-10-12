<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
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
        $recommendedJobs = \App\Models\Job::published()
            ->active()
            ->where('location', 'like', '%' . ($profile->city ?? '') . '%')
            ->orWhereHas('company', function($query) use ($profile) {
                if ($profile && $profile->skills) {
                    $query->where('industry', 'like', '%' . implode('%', $profile->skills) . '%');
                }
            })
            ->limit(6)
            ->get();
        
        // Statistics for dashboard
        $stats = [
            'total_applications' => $applicationsCount,
            'pending_applications' => $pendingApplications,
            'reviewed_applications' => $reviewedApplications,
            'shortlisted_applications' => $shortlistedApplications,
            'success_rate' => $applicationsCount > 0 ? round(($shortlistedApplications / $applicationsCount) * 100, 1) : 0,
        ];
        
        return view('dashboard.candidate.index', compact(
            'user', 
            'profile', 
            'applications', 
            'recentApplications', 
            'recommendedJobs', 
            'stats'
        ));
    }
}