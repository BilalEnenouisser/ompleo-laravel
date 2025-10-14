<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobsController extends Controller
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

    /**
     * Display a listing of all jobs
     */
    public function index(Request $request)
    {
        $query = Job::with(['company', 'recruiter', 'applications']);

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by company
        if ($request->has('company_id') && $request->company_id !== '') {
            $query->where('company_id', $request->company_id);
        }

        // Search by title
        if ($request->has('search') && $request->search !== '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $jobs = $query->orderBy('created_at', 'desc')->paginate(20);
        $companies = Company::all();
        
        // Statistics
        $stats = [
            'total_jobs' => Job::count(),
            'published_jobs' => Job::where('status', 'published')->count(),
            'draft_jobs' => Job::where('status', 'draft')->count(),
            'closed_jobs' => Job::where('status', 'closed')->count(),
        ];

        return view('dashboard.admin.jobs', compact('jobs', 'companies', 'stats'));
    }

    /**
     * Display the specified job
     */
    public function show(Job $job)
    {
        $job->load(['company', 'recruiter', 'applications.candidate']);
        
        return view('dashboard.admin.job-detail', compact('job'));
    }

    /**
     * Update job status
     */
    public function updateStatus(Request $request, Job $job)
    {
        $request->validate([
            'status' => 'required|in:draft,published,closed'
        ]);

        $job->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Statut de l\'offre mis à jour avec succès!');
    }

    /**
     * Remove the specified job
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs')->with('success', 'Offre d\'emploi supprimée avec succès!');
    }
}
