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
            
            // Today's statistics
            'actions_today' => \App\Models\Job::whereDate('created_at', today())->count() + 
                              \App\Models\Application::whereDate('created_at', today())->count() + 
                              \App\Models\User::whereDate('created_at', today())->count(),
            'jobs_today' => \App\Models\Job::whereDate('created_at', today())->count(),
            'applications_today' => \App\Models\Application::whereDate('created_at', today())->count(),
            'users_today' => \App\Models\User::whereDate('created_at', today())->count(),
            
            // This week's statistics
            'jobs_this_week' => \App\Models\Job::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'applications_this_week' => \App\Models\Application::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'users_this_week' => \App\Models\User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            
            // This month's statistics
            'jobs_this_month' => \App\Models\Job::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'applications_this_month' => \App\Models\Application::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'users_this_month' => \App\Models\User::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
        ];

        // Get ALL recent activities - mix of all user activities
        $recentJobs = \App\Models\Job::with(['company', 'recruiter'])
            ->orderBy('created_at', 'desc')
            ->get();

        $recentApplications = \App\Models\Application::with(['job.company', 'candidate'])
            ->orderBy('created_at', 'desc')
            ->get();

        $recentUsers = \App\Models\User::orderBy('created_at', 'desc')
            ->get();

        // Create activities for tracking - mix of real and sample data
        $allActivities = collect();
        
        // Add recent applications as activities
        foreach ($recentApplications as $application) {
            try {
                $allActivities->push([
                    'type' => 'application',
                    'user_name' => $application->candidate->name ?? 'Utilisateur inconnu',
                    'user_type' => 'candidate',
                    'activity' => 'Candidature envoyée',
                    'description' => 'Candidature pour "' . ($application->job->title ?? 'Poste inconnu') . '" chez ' . ($application->job->company->name ?? 'Entreprise inconnue'),
                    'url' => '/jobs/' . ($application->job->slug ?? ''),
                    'time' => $application->created_at,
                    'status' => 'Succès',
                    'icon_color' => 'blue'
                ]);
            } catch (\Exception $e) {
                // Skip if there's an error with this application
                continue;
            }
        }
        
        // Add recent jobs as activities
        foreach ($recentJobs as $job) {
            try {
                
                $allActivities->push([
                    'type' => 'job',
                    'user_name' => $job->recruiter->name ?? 'Recruteur inconnu',
                    'user_type' => 'recruiter',
                    'activity' => 'Publication offre',
                    'description' => 'Nouvelle offre "' . $job->title . '" publiée',
                    'url' => '/recruiter/create-offer',
                    'time' => $job->created_at,
                    'status' => 'Succès',
                    'icon_color' => 'green'
                ]);
            } catch (\Exception $e) {
                continue;
            }
        }
        
        // Add recent admin users as activities
        foreach ($recentUsers->where('user_type', 'admin') as $admin) {
            $allActivities->push([
                'type' => 'admin',
                'user_name' => $admin->name,
                'user_type' => 'admin',
                'activity' => 'Création article blog',
                'description' => 'Nouvel article "Comment rédiger un CV"',
                'url' => '/admin/blog',
                'time' => $admin->created_at,
                'status' => 'Succès',
                'icon_color' => 'purple'
            ]);
        }
        
        // Add recent candidate users as activities
        foreach ($recentUsers->where('user_type', 'candidate') as $candidate) {
            $allActivities->push([
                'type' => 'candidate',
                'user_name' => $candidate->name,
                'user_type' => 'candidate',
                'activity' => 'Inscription candidat',
                'description' => 'Nouveau candidat inscrit sur la plateforme',
                'url' => '/candidate/profile',
                'time' => $candidate->created_at,
                'status' => 'Succès',
                'icon_color' => 'blue'
            ]);
        }
        
        // Add recent recruiter users as activities
        foreach ($recentUsers->where('user_type', 'recruiter') as $recruiter) {
            $allActivities->push([
                'type' => 'recruiter',
                'user_name' => $recruiter->name,
                'user_type' => 'recruiter',
                'activity' => 'Inscription recruteur',
                'description' => 'Nouveau recruteur inscrit sur la plateforme',
                'url' => '/recruiter/dashboard',
                'time' => $recruiter->created_at,
                'status' => 'Succès',
                'icon_color' => 'green'
            ]);
        }
        
        // If no real activities, add sample activities
        if ($allActivities->isEmpty()) {
            $allActivities->push([
                'type' => 'admin',
                'user_name' => 'Système',
                'user_type' => 'admin',
                'activity' => 'Système initialisé',
                'description' => 'Tableau de bord admin activé',
                'url' => '/admin/dashboard',
                'time' => \Carbon\Carbon::now(),
                'status' => 'Succès',
                'icon_color' => 'purple'
            ]);
        }
        
        // Sort all activities by time - show ALL activities
        $allRecentActivities = collect($allActivities->sortByDesc('time'));
        
        // Limit to 6 for display, but keep all for popup
        $recentActivities = $allRecentActivities->take(6);
        
        

        // Get top companies with job and application counts
        $topCompanies = \App\Models\Company::withCount(['jobs', 'applications'])
            ->orderBy('applications_count', 'desc')
            ->limit(7)
            ->get();


        return view('dashboard.admin.index', compact('user', 'stats', 'recentJobs', 'recentApplications', 'recentUsers', 'topCompanies', 'recentActivities', 'allRecentActivities'));
    }
}