<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Company;

class JobController extends Controller
{
    public function index(Request $request)
    {
        // Real database queries
        $query = Job::with(['company', 'recruiter'])
            ->published()
            ->active();

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('company', function ($companyQuery) use ($search) {
                      $companyQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Apply location filter
        if ($request->filled('location')) {
            $query->byLocation($request->location);
        }

        // Apply type filter
        if ($request->filled('type')) {
            $query->byType($request->type);
        }

        // Paginate results
        $jobs = $query->orderBy('created_at', 'desc')->paginate(6);

        // Featured companies (real data)
        $featuredCompanies = Company::active()
            ->withCount('jobs')
            ->having('jobs_count', '>', 0)
            ->orderBy('jobs_count', 'desc')
            ->limit(3)
            ->get();

        return view('jobs.index', compact('jobs', 'featuredCompanies'));
    }

    public function show($slug)
    {
        // Real database query
        $job = Job::with(['company', 'recruiter', 'applications'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        return view('jobs.show', compact('job'));
    }

    public function create()
    {
        return view('jobs.create');
    }
}

