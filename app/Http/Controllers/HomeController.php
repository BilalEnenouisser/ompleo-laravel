<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Company;
use App\Models\User;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [ 'jobs_count' => Job::published()->count(), 'companies_count' => Company::where('is_active', true)->count(), 'candidates_count' => User::where('user_type', 'candidate')->count() ]; $companies = Company::where('is_active', true) ->withCount(['jobs' => function($query) { $query->where('status', 'published'); }]) ->having('jobs_count', '>', 0) ->orderBy('jobs_count', 'desc') ->orderBy('created_at', 'desc') ->limit(6) ->get(); $featuredBlogs = \App\Models\Blog::where('status', 'published') ->orderBy('created_at', 'desc') ->limit(6) ->get(); $jobs = Job::published() ->with('company') ->orderBy('is_featured', 'desc') ->orderBy('created_at', 'desc') ->limit(3) ->get(); $heroPartners = Partner::whereNotNull('logo') ->orderByDesc('is_featured') ->orderBy('sort_order') ->orderBy('name') ->get() ->map(function ($partner) { return [ 'name' => $partner->name, 'logo' => Storage::url($partner->logo), ]; }); $latestJobs = Job::published() ->orderBy('created_at', 'desc') ->limit(8) ->get(); $features = config('content_catalog.home.features', []); return view('home', compact('stats', 'features', 'companies', 'featuredBlogs', 'jobs', 'latestJobs', 'heroPartners'));
    }
}

