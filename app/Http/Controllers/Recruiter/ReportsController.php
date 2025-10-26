<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $recruiter = Auth::user();
        
        // Get recruiter's company
        $company = $recruiter->recruiterProfile?->company;
        
        if (!$company) {
            // If no company, return empty data
            $stats = [
                'total_jobs' => 0,
                'total_applications' => 0,
                'total_views' => 0,
                'conversion_rate' => 0,
                'applications_trend' => [],
                'candidate_sources' => [],
                'job_performance' => [],
                'application_status' => [
                    'pending' => 0,
                    'accepted' => 0,
                    'rejected' => 0
                ],
                'response_time' => 0
            ];
            
            return view('dashboard.recruiter.reports', compact('stats'));
        }
        
        // Get date range (default to last 30 days)
        $days = $request->get('days', 30);
        $startDate = Carbon::now()->subDays($days);
        
        // Basic stats
        $totalJobs = Job::where('recruiter_id', $recruiter->id)
            ->where('status', 'published')
            ->count();
            
        $totalApplications = Application::whereHas('job', function($query) use ($recruiter) {
            $query->where('recruiter_id', $recruiter->id);
        })->count();
        
        $totalViews = Job::where('recruiter_id', $recruiter->id)
            ->where('status', 'published')
            ->sum('views') ?? 0;
            
        $conversionRate = $totalViews > 0 ? round(($totalApplications / $totalViews) * 100, 1) : 0;
        
        // Applications trend (last 4 months)
        $applicationsTrend = [];
        for ($i = 3; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthStart = $month->copy()->startOfMonth();
            $monthEnd = $month->copy()->endOfMonth();
            
            $applications = Application::whereHas('job', function($query) use ($recruiter) {
                $query->where('recruiter_id', $recruiter->id);
            })->whereBetween('created_at', [$monthStart, $monthEnd])->count();
            
            $views = Job::where('recruiter_id', $recruiter->id)
                ->where('status', 'published')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->sum('views') ?? 0;
            
            $applicationsTrend[] = [
                'month' => $month->format('M'),
                'applications' => $applications,
                'views' => $views,
                'percentage' => $views > 0 ? round(($applications / $views) * 100) : 0
            ];
        }
        
        // Candidate sources (simplified - in real app, you'd track this)
        $candidateSources = [
            ['name' => 'Recherche directe', 'count' => round($totalApplications * 0.45), 'percentage' => 45],
            ['name' => 'Profils recommandés', 'count' => round($totalApplications * 0.30), 'percentage' => 30],
            ['name' => 'Candidatures spontanées', 'count' => round($totalApplications * 0.15), 'percentage' => 15],
            ['name' => 'Réseaux sociaux', 'count' => round($totalApplications * 0.10), 'percentage' => 10]
        ];
        
        // Job performance
        $jobPerformance = Job::where('recruiter_id', $recruiter->id)
            ->where('status', 'published')
            ->withCount('applications')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function($job) {
                $conversionRate = $job->views > 0 ? round(($job->applications_count / $job->views) * 100, 1) : 0;
                $status = $job->application_deadline && $job->application_deadline < now() ? 'Expiré' : 'Actif';
                
                return [
                    'title' => $job->title,
                    'views' => $job->views ?? 0,
                    'applications' => $job->applications_count,
                    'conversion_rate' => $conversionRate . '%',
                    'status' => $status,
                    'date' => $job->created_at->format('Y-m-d')
                ];
            });
        
        // Application status
        $applicationStatus = [
            'pending' => Application::whereHas('job', function($query) use ($recruiter) {
                $query->where('recruiter_id', $recruiter->id);
            })->where('status', 'pending')->count(),
            'accepted' => Application::whereHas('job', function($query) use ($recruiter) {
                $query->where('recruiter_id', $recruiter->id);
            })->where('status', 'accepted')->count(),
            'rejected' => Application::whereHas('job', function($query) use ($recruiter) {
                $query->where('recruiter_id', $recruiter->id);
            })->where('status', 'rejected')->count()
        ];
        
        // Response time (simplified calculation)
        $responseTime = 2.3; // Default value, in real app calculate from actual response times
        
        // Trends data for the trends section
        $trendsData = $this->getTrendsData($recruiter, $days);
        
        $stats = [
            'total_jobs' => $totalJobs,
            'total_applications' => $totalApplications,
            'total_views' => $totalViews,
            'conversion_rate' => $conversionRate,
            'applications_trend' => $applicationsTrend,
            'candidate_sources' => $candidateSources,
            'job_performance' => $jobPerformance,
            'application_status' => $applicationStatus,
            'response_time' => $responseTime,
            'trends' => $trendsData
        ];
        
        return view('dashboard.recruiter.reports', compact('stats'));
    }
    
    private function getTrendsData($recruiter, $days)
    {
        $startDate = Carbon::now()->subDays($days);
        
        // Weekly applications trend
        $weeklyApplications = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayStart = $date->copy()->startOfDay();
            $dayEnd = $date->copy()->endOfDay();
            
            $applications = Application::whereHas('job', function($query) use ($recruiter) {
                $query->where('recruiter_id', $recruiter->id);
            })->whereBetween('created_at', [$dayStart, $dayEnd])->count();
            
            $weeklyApplications[] = [
                'date' => $date->format('M d'),
                'applications' => $applications
            ];
        }
        
        // Monthly job performance trend
        $monthlyJobTrend = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthStart = $month->copy()->startOfMonth();
            $monthEnd = $month->copy()->endOfMonth();
            
            $jobs = Job::where('recruiter_id', $recruiter->id)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
            
            $views = Job::where('recruiter_id', $recruiter->id)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->sum('views') ?? 0;
            
            $monthlyJobTrend[] = [
                'month' => $month->format('M Y'),
                'jobs' => $jobs,
                'views' => $views
            ];
        }
        
        // Top performing job categories (using company industry)
        $jobCategories = Job::where('recruiter_id', $recruiter->id)
            ->where('status', 'published')
            ->with('company')
            ->get()
            ->groupBy(function($job) {
                return $job->company ? $job->company->industry : 'Non spécifié';
            })
            ->map(function($jobs, $industry) {
                return [
                    'category' => $industry ?: 'Non spécifié',
                    'jobs' => $jobs->count(),
                    'views' => $jobs->sum('views')
                ];
            })
            ->sortByDesc('views')
            ->take(5)
            ->values();
        
        // Application status trend over time
        $statusTrend = [];
        for ($i = 3; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthStart = $month->copy()->startOfMonth();
            $monthEnd = $month->copy()->endOfMonth();
            
            $pending = Application::whereHas('job', function($query) use ($recruiter) {
                $query->where('recruiter_id', $recruiter->id);
            })->where('status', 'pending')
              ->whereBetween('created_at', [$monthStart, $monthEnd])->count();
            
            $accepted = Application::whereHas('job', function($query) use ($recruiter) {
                $query->where('recruiter_id', $recruiter->id);
            })->where('status', 'accepted')
              ->whereBetween('created_at', [$monthStart, $monthEnd])->count();
            
            $rejected = Application::whereHas('job', function($query) use ($recruiter) {
                $query->where('recruiter_id', $recruiter->id);
            })->where('status', 'rejected')
              ->whereBetween('created_at', [$monthStart, $monthEnd])->count();
            
            $statusTrend[] = [
                'month' => $month->format('M'),
                'pending' => $pending,
                'accepted' => $accepted,
                'rejected' => $rejected
            ];
        }
        
        // Conversion rate trend
        $conversionTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayStart = $date->copy()->startOfDay();
            $dayEnd = $date->copy()->endOfDay();
            
            $applications = Application::whereHas('job', function($query) use ($recruiter) {
                $query->where('recruiter_id', $recruiter->id);
            })->whereBetween('created_at', [$dayStart, $dayEnd])->count();
            
            $views = Job::where('recruiter_id', $recruiter->id)
                ->whereBetween('created_at', [$dayStart, $dayEnd])
                ->sum('views') ?? 0;
            
            $conversionRate = $views > 0 ? round(($applications / $views) * 100, 1) : 0;
            
            $conversionTrend[] = [
                'date' => $date->format('M d'),
                'rate' => $conversionRate
            ];
        }
        
        return [
            'weekly_applications' => $weeklyApplications,
            'monthly_job_trend' => $monthlyJobTrend,
            'job_categories' => $jobCategories,
            'status_trend' => $statusTrend,
            'conversion_trend' => $conversionTrend
        ];
    }
}
