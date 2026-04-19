<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\CandidateProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        // Get all active companies with their job counts
        $query = Company::where('is_active', true)
            ->withCount(['jobs' => function($query) {
                $query->where('status', 'published');
            }]);

        // Company name filter
        if ($request->filled('company_name')) {
            $query->where('name', 'like', "%{$request->company_name}%");
        }

        // Location filter
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Industry filter
        if ($request->filled('industry')) {
            $query->where('industry', 'like', "%{$request->industry}%");
        }

        $companies = $query->orderBy('jobs_count', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        
        // Get company count for stats
        $companyCount = Company::where('is_active', true)->count();

        // Get unique values for filters
        $companyNames = Company::where('is_active', true)
            ->orderBy('name')
            ->pluck('name')
            ->unique()
            ->values();
        
        $locations = Company::where('is_active', true)
            ->whereNotNull('location')
            ->orderBy('location')
            ->pluck('location')
            ->unique()
            ->values();
        
        $industries = Company::where('is_active', true)
            ->whereNotNull('industry')
            ->orderBy('industry')
            ->pluck('industry')
            ->unique()
            ->values();

        // Handle AJAX load more request
        if ($request->ajax()) {
            return response()->json([
                'html' => view('companies.companies-partial', compact('companies'))->render(),
                'has_more' => $companies->hasMorePages(),
                'next_page' => $companies->currentPage() + 1
            ]);
        }

        return view('companies.index', compact('companies', 'companyCount', 'companyNames', 'locations', 'industries'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $candidates = User::where('user_type', 'candidate')
            ->whereHas('candidateProfile')
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%")
                  ->orWhereHas('candidateProfile', function($profileQuery) use ($query) {
                      $profileQuery->where('title', 'like', "%{$query}%")
                                   ->orWhere('bio', 'like', "%{$query}%")
                                   ->orWhere('skills', 'like', "%{$query}%");
                  });
            })
            ->with('candidateProfile')
            ->limit(8)
            ->get(['id', 'name', 'email']);

        return response()->json($candidates);
    }

    public function show($id)
    {
        // Show candidate profile instead of company
        $candidate = User::where('user_type', 'candidate')
            ->whereHas('candidateProfile')
            ->with('candidateProfile')
            ->findOrFail($id);

        $profile = $candidate->candidateProfile;
        
        if (!$profile) {
            abort(404);
        }

        return view('companies.show', compact('candidate', 'profile'));
    }

    public function showCompany($slug)
    {
        // Find company by slug or ID
        $company = Company::where('slug', $slug)
            ->orWhere('id', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get published jobs for this company
        $jobs = $company->jobs()
            ->where('status', 'published')
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('companies.company-detail', compact('company', 'jobs'));
    }

    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|min:10|max:1000',
        ]);

        $this->authorize('sendMessage', Company::class);

        $recruiter = auth()->user();
        $candidate = User::where('user_type', 'candidate')->findOrFail($id);

        $recruiter->load('recruiterProfile.company');
        $recruiterName = $recruiter->name ?? 'Un recruteur';
        $companyName = $recruiter->recruiterProfile?->company?->name ?? 'une entreprise';

        $notificationService = app(\App\Services\NotificationService::class);
        
        $title = "Nouveau message de {$recruiterName}";
        $message = "{$recruiterName} de {$companyName} vous a envoyé un message:\n\n{$request->message}";

        try {
            $notificationService->createNotification(
                $title,
                $message,
                'info',
                [$candidate->id]
            );

            return response()->json(['success' => true, 'message' => 'Message envoyé avec succès']);
        } catch (\Exception $e) {
            \Log::error('Failed to send message: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de l\'envoi du message'], 500);
        }
    }
}