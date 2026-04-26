<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Blog;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
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
        
        $stats = [
            'total_users' => User::count(),
            'candidates' => User::where('user_type', 'candidate')->count(),
            'recruiters' => User::where('user_type', 'recruiter')->count(),
            'total_companies' => Company::count(),
            'companies' => Company::count(),
            'total_jobs' => Job::count(),
            'published_jobs' => Job::where('status', 'published')->count(),
            'draft_jobs' => Job::where('status', 'draft')->count(),
            'pending_jobs' => Job::where('status', 'pending')->count(),
            'closed_jobs' => Job::whereIn('status', ['expired', 'closed', 'suspended'])->count(),
            'total_applications' => Application::count(),
            'pending_applications' => Application::where('status', 'pending')->count(),

            'actions_today' => Job::whereDate('created_at', today())->count()
                + Application::whereDate('created_at', today())->count()
                + User::whereDate('created_at', today())->count(),
            'jobs_today' => Job::whereDate('created_at', today())->count(),
            'applications_today' => Application::whereDate('created_at', today())->count(),
            'users_today' => User::whereDate('created_at', today())->count(),

            'jobs_this_week' => Job::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'applications_this_week' => Application::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'users_this_week' => User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),

            'jobs_this_month' => Job::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'applications_this_month' => Application::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'users_this_month' => User::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
        ];

        $recentJobs = Job::with(['company', 'recruiter'])
            ->latest()
            ->limit(20)
            ->get();

        $recentApplications = Application::with(['job.company', 'candidate'])
            ->latest()
            ->limit(20)
            ->get();

        $recentUsers = User::latest()
            ->limit(20)
            ->get();

        $recentBlogs = Blog::latest()
            ->limit(20)
            ->get();

        $allActivities = collect();
        
        foreach ($recentApplications as $application) {
            $allActivities->push([
                'type' => 'application',
                'user_name' => $application->candidate->name ?? 'Utilisateur inconnu',
                'user_type' => 'candidate',
                'activity' => 'Candidature envoyée',
                'description' => 'Candidature pour "' . ($application->job->title ?? 'Poste inconnu') . '" chez ' . ($application->job->company->name ?? 'Entreprise inconnue'),
                'url' => '/applications/' . $application->id,
                'time' => $application->created_at,
                'status' => 'Succès',
                'icon_color' => 'blue'
            ]);
        }
        
        foreach ($recentJobs as $job) {
            $allActivities->push([
                'type' => 'job',
                'user_name' => $job->recruiter->name ?? 'Recruteur inconnu',
                'user_type' => 'recruiter',
                'activity' => 'Publication offre',
                'description' => 'Nouvelle offre "' . $job->title . '" publiée',
                'url' => '/recruiter/jobs/' . $job->id,
                'time' => $job->created_at,
                'status' => 'Succès',
                'icon_color' => 'green'
            ]);
        }
        
        foreach ($recentUsers as $account) {
            $activityLabel = match ($account->user_type) {
                'candidate' => 'Inscription candidat',
                'recruiter' => 'Inscription recruteur',
                'admin' => 'Inscription administrateur',
                default => 'Inscription utilisateur',
            };

            $allActivities->push([
                'type' => 'user',
                'user_name' => $account->name,
                'user_type' => $account->user_type,
                'activity' => $activityLabel,
                'description' => 'Nouvel utilisateur inscrit sur la plateforme',
                'url' => '/admin/users/' . $account->id,
                'time' => $account->created_at,
                'status' => 'Succès',
                'icon_color' => 'purple'
            ]);
        }

        foreach ($recentBlogs as $blog) {
            $allActivities->push([
                'type' => 'blog',
                'user_name' => $blog->author_name ?: 'Admin',
                'user_type' => 'admin',
                'activity' => 'Publication article',
                'description' => 'Article "' . $blog->title . '" créé',
                'url' => '/admin/blog/' . $blog->id,
                'time' => $blog->created_at,
                'status' => 'Succès',
                'icon_color' => 'purple'
            ]);
        }

        $allRecentActivities = $allActivities->sortByDesc('time')->values();
        $recentActivities = $allRecentActivities->take(6);

        $topCompanies = Company::withCount(['jobs', 'applications'])
            ->orderBy('applications_count', 'desc')
            ->limit(7)
            ->get();


        return view('dashboard.admin.index', compact('user', 'stats', 'recentJobs', 'recentApplications', 'recentUsers', 'topCompanies', 'recentActivities', 'allRecentActivities'));
    }
}