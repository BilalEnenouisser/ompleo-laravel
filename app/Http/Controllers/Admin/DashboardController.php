<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->user_type !== 'admin') {
                abort(403, 'Accès non autorisé');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $user = Auth::user();
        
        // Get statistics
        $stats = [
            'total_users' => \App\Models\User::count(),
            'candidates' => \App\Models\User::where('user_type', 'candidate')->count(),
            'recruiters' => \App\Models\User::where('user_type', 'recruiter')->count(),
            'total_companies' => \App\Models\Company::count(),
            'companies' => \App\Models\Company::count(),
            'total_jobs' => \App\Models\Job::count(),
            'published_jobs' => \App\Models\Job::where('status', 'published')->count(),
            'draft_jobs' => \App\Models\Job::where('status', 'draft')->count(),
            'total_applications' => \App\Models\Application::count(),
            'pending_applications' => \App\Models\Application::where('status', 'pending')->count(),
        ];

        // Get recent activities
        $recentJobs = \App\Models\Job::with(['company', 'recruiter'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentApplications = \App\Models\Application::with(['job.company', 'candidate'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentUsers = \App\Models\User::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get top companies with job and application counts
        $topCompanies = \App\Models\Company::withCount(['jobs', 'applications'])
            ->orderBy('applications_count', 'desc')
            ->limit(5)
            ->get();

        // Get recent activities (simplified for now)
        $recentActivities = [
            [
                'title' => 'Nouvelle candidature',
                'description' => 'Candidature reçue pour un poste',
                'time' => 'Il y a 5 minutes'
            ],
            [
                'title' => 'Offre publiée',
                'description' => 'Nouvelle offre d\'emploi publiée',
                'time' => 'Il y a 1 heure'
            ],
            [
                'title' => 'Utilisateur inscrit',
                'description' => 'Nouvel utilisateur sur la plateforme',
                'time' => 'Il y a 2 heures'
            ]
        ];

        return view('dashboard.admin.index', compact('user', 'stats', 'recentJobs', 'recentApplications', 'recentUsers', 'topCompanies', 'recentActivities'));
    }
}