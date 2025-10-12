<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('status', 'published')
            ->with('company')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        $job->load('company');
        
        return view('jobs.show', compact('job'));
    }
}