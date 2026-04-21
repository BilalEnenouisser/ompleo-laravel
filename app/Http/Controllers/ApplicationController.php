<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;
use App\Services\FileUploadService;
use App\Services\NotificationService;
use App\Http\Requests\StoreApplicationRequest;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    protected $fileUploadService;
    protected $notificationService;

    public function __construct(FileUploadService $fileUploadService, NotificationService $notificationService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->notificationService = $notificationService;
    }

    /**
     * Display a listing of applications for the authenticated user
     */
    public function index(Request $request)
    {
        $this->authorize('scanner-pass'); $user = Auth::user(); if ($user->isCandidate()) { $query = $user->applications()->with(['job.company']); if ($request->filled('search')) { $search = $request->search; $query->where(function($q) use ($search) { $q->whereHas('job', function($jobQuery) use ($search) { $jobQuery->where('title', 'like', "%{$search}%") ->orWhere('description', 'like', "%{$search}%") ->orWhereHas('company', function($companyQuery) use ($search) { $companyQuery->where('name', 'like', "%{$search}%"); }); }); }); } if ($request->filled('status')) { $status = $request->status; $statusMap = [ 'En cours' => 'pending', 'Accepté' => 'accepted', 'Refusé' => 'rejected', 'En attente' => 'pending', 'Présélectionné' => 'shortlisted', 'Examiné' => 'reviewed' ]; if (isset($statusMap[$status])) { $query->where('status', $statusMap[$status]); } } $applications = $query->orderBy('applied_at', 'desc')->paginate(10); $stats = [ 'total' => $user->applications()->count(), 'pending' => $user->applications()->where('status', 'pending')->count(), 'accepted' => $user->applications()->where('status', 'accepted')->count(), 'rejected' => $user->applications()->where('status', 'rejected')->count(), ]; return view('dashboard.candidate.applications', compact('applications', 'stats')); } elseif ($user->isRecruiter()) { $query = Application::whereHas('job', function($query) use ($user) { $query->where('recruiter_id', $user->id); })->with(['job.company', 'candidate']); if ($request->filled('search')) { $search = $request->search; $query->where(function($q) use ($search) { $q->whereHas('job', function($jobQuery) use ($search) { $jobQuery->where('title', 'like', "%{$search}%") ->orWhere('description', 'like', "%{$search}%"); })->orWhereHas('candidate', function($candidateQuery) use ($search) { $candidateQuery->where('name', 'like', "%{$search}%") ->orWhere('email', 'like', "%{$search}%"); }); }); } if ($request->filled('status')) { $status = $request->status; $statusMap = [ 'En cours' => 'pending', 'Accepté' => 'accepted', 'Refusé' => 'rejected', 'En attente' => 'pending', 'Présélectionné' => 'shortlisted', 'Examiné' => 'reviewed' ]; if (isset($statusMap[$status])) { $query->where('status', $statusMap[$status]); } } $applications = $query->orderBy('applied_at', 'desc')->paginate(10); } else { $applications = Application::with(['job.company', 'candidate'])->paginate(10); } return view('applications.index', compact('applications'));
    }

    /**
     * Export applications to PDF
     */
    public function exportPdf(Request $request)
    {
        $this->authorize('scanner-pass'); $user = Auth::user(); if (!$user->isCandidate()) { abort(403, 'Unauthorized'); } $query = $user->applications()->with(['job.company']); if ($request->filled('search')) { $search = $request->search; $query->where(function($q) use ($search) { $q->whereHas('job', function($jobQuery) use ($search) { $jobQuery->where('title', 'like', "%{$search}%") ->orWhere('description', 'like', "%{$search}%") ->orWhereHas('company', function($companyQuery) use ($search) { $companyQuery->where('name', 'like', "%{$search}%"); }); }); }); } if ($request->filled('status')) { $status = $request->status; $statusMap = [ 'En cours' => 'pending', 'Accepté' => 'accepted', 'Refusé' => 'rejected', 'En attente' => 'pending', 'Présélectionné' => 'shortlisted', 'Examiné' => 'reviewed' ]; if (isset($statusMap[$status])) { $query->where('status', $statusMap[$status]); } } $applications = $query->orderBy('applied_at', 'desc')->get(); $stats = [ 'total' => $user->applications()->count(), 'pending' => $user->applications()->where('status', 'pending')->count(), 'accepted' => $user->applications()->where('status', 'accepted')->count(), 'rejected' => $user->applications()->where('status', 'rejected')->count(), ]; $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.applications', compact('applications', 'stats', 'user')); return $pdf->download('mes-candidatures-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Show the form for creating a new application
     */
    public function create(Job $job)
    {
        $this->authorize('scanner-pass');
        // Check if user already applied
        $existingApplication = Application::where('job_id', $job->id)
            ->where('candidate_id', Auth::id())
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'Vous avez déjà postulé à cette offre.');
        }

        return view('applications.create', compact('job'));
    }

    /**
     * Store a newly created application
     */
    public function store(StoreApplicationRequest $request)
    {
        $this->authorize('scanner-pass'); $user = Auth::user(); if (!$user->isCandidate()) { return redirect()->back()->with('error', 'Seuls les candidats peuvent postuler.'); } try { $resumePath = null; if ($request->hasFile('resume')) { $resumePath = $this->fileUploadService->uploadResume($request->file('resume')); } $application = Application::create([ 'job_id' => $request->job_id, 'candidate_id' => $user->id, 'cover_letter' => $request->cover_letter, 'resume_path' => $resumePath, 'status' => 'pending', 'applied_at' => now(), ]); $application->load(['job.company', 'job.recruiter', 'candidate']); try { $this->notificationService->notifyApplicationReceived($application); } catch (\Exception $e) { } return redirect()->route('jobs.show', $application->job->slug) ->with('success', 'Votre candidature a été envoyée avec succès!'); } catch (\Exception $e) { return redirect()->back() ->withInput() ->with('error', 'Erreur lors de l\'envoi de la candidature: ' . $e->getMessage()); }
    }


    /**
     * Display the specified application
     */
    public function show(Application $application)
    {
        $this->authorize('scanner-pass');
        $user = Auth::user();
        
        // Check if user can view this application
        if ($user->isCandidate() && $application->candidate_id !== $user->id) {
            abort(403, 'Access denied.');
        }
        
        if ($user->isRecruiter() && $application->job->recruiter_id !== $user->id) {
            abort(403, 'Access denied.');
        }

        $application->load(['job.company', 'candidate']);

        return view('applications.show', compact('application'));
    }

    /**
     * Update application status (for recruiters)
     */
    public function updateStatus(Request $request, Application $application)
    {
        $this->authorize('scanner-pass'); $user = Auth::user(); if (!$user->isRecruiter() && !$user->isAdmin()) { abort(403, 'Access denied.'); } $request->validate([ 'status' => 'required|in:pending,reviewed,shortlisted,rejected,accepted' ]); try { $oldStatus = $application->status; $application->updateStatus($request->status); $application->load(['job.company', 'candidate']); if ($oldStatus !== $request->status && in_array($request->status, ['accepted', 'rejected', 'shortlisted'])) { try { $this->notificationService->notifyApplicationStatusUpdate($application, $request->status); } catch (\Exception $e) { } } return redirect()->back() ->with('success', 'Statut de la candidature mis à jour.'); } catch (\Exception $e) { return redirect()->back() ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage()); }
    }

    /**
     * Withdraw application (for candidates)
     */
    public function withdraw(Application $application)
    {
        $this->authorize('scanner-pass');
        $user = Auth::user();
        
        if (!$user->isCandidate() || $application->candidate_id !== $user->id) {
            abort(403, 'Access denied.');
        }

        $application->delete();

        return redirect()->route('applications.index')
            ->with('success', 'Candidature retirée avec succès.');
    }
}
