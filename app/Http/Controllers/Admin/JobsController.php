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
        // Start with basic query
        $query = Job::query();

        // Apply filters only if they have values
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        if ($request->filled('date_filter')) {
            switch ($request->date_filter) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                    break;
                case 'year':
                    $query->whereYear('created_at', now()->year);
                    break;
            }
        }

        $jobs = $query->with(['company', 'applications'])
            ->withCount('applications')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        $companies = Company::all();
        
        
        // Dynamic Statistics
        $stats = [
            'total_jobs' => Job::count(),
            'published_jobs' => Job::where('status', 'published')->count(),
            'draft_jobs' => Job::where('status', 'draft')->count(),
            'closed_jobs' => Job::where('status', 'closed')->count(),
            'expired_jobs' => Job::where('status', 'expired')->count(),
            'suspended_jobs' => Job::where('status', 'suspended')->count(),
            'pending_jobs' => Job::where('status', 'pending')->count(),
            'jobs_today' => Job::whereDate('created_at', today())->count(),
            'jobs_this_week' => Job::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'jobs_this_month' => Job::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
        ];

        return view('dashboard.admin.jobs', compact('jobs', 'companies', 'stats'));
    }

    /**
     * Display the specified job
     */
    public function show($id)
    {
        // Find job by ID instead of using route model binding
        $job = Job::find($id);
        
        if (!$job) {
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json(['error' => 'Job not found'], 404);
            }
            abort(404, 'Job not found');
        }
        
        $job->load(['company', 'recruiter', 'applications']);
        
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'id' => $job->id,
                'title' => $job->title,
                'slug' => $job->slug,
                'description' => $job->description,
                'responsibilities' => $job->responsibilities,
                'requirements' => $job->requirements,
                'benefits' => $job->benefits,
                'location' => $job->location,
                'type' => $job->type,
                'work_type' => $job->work_type,
                'experience_level' => $job->experience_level,
                'tags' => $job->tags,
                'salary_min' => $job->salary_min,
                'salary_max' => $job->salary_max,
                'status' => $job->status,
                'application_deadline' => $job->application_deadline,
                'is_featured' => $job->is_featured,
                'applications_count' => $job->applications->count(),
                'views_count' => $job->views_count ?? 0,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at,
                'company' => $job->company,
                'recruiter' => $job->recruiter
            ]);
        }
        
        return view('dashboard.admin.job-detail', compact('job'));
    }

    /**
     * Update the specified job
     */
    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        
        if (!$job) {
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json(['error' => 'Job not found'], 404);
            }
            abort(404, 'Job not found');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'experience_level' => 'required|string|max:255',
            'type' => 'required|in:CDI,CDD,Freelance,Stage',
            'work_type' => 'required|in:onsite,remote,hybrid',
            'salary_min' => 'required|numeric|min:0',
            'salary_max' => 'required|numeric|min:0|gte:salary_min',
            'application_deadline' => 'required|date',
            'responsibilities' => 'nullable|array',
            'requirements' => 'nullable|array',
            'benefits' => 'nullable|array',
            'skills' => 'nullable|array',
            'status' => 'required|in:published,draft,pending,expired,closed,suspended',
            'is_featured' => 'nullable|boolean'
        ]);

        try {
            $job->update($request->all());
        } catch (\Exception $e) {
            
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json(['error' => 'Erreur lors de la mise à jour: ' . $e->getMessage()], 500);
            }
            
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
        }

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Offre mise à jour avec succès']);
        }

        return redirect()->back()->with('success', 'Offre d\'emploi mise à jour avec succès!');
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
    public function destroy($id)
    {
        $job = Job::find($id);
        
        if (!$job) {
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json(['error' => 'Job not found'], 404);
            }
            abort(404, 'Job not found');
        }

        $job->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Offre supprimée avec succès']);
        }

        return redirect()->route('admin.jobs')->with('success', 'Offre d\'emploi supprimée avec succès!');
    }
}
