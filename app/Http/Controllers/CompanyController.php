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
        // Get all candidate users with their profiles
        $query = User::where('user_type', 'candidate')
            ->whereHas('candidateProfile')
            ->with(['candidateProfile']);

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('candidateProfile', function($profileQuery) use ($search) {
                      $profileQuery->where('bio', 'like', "%{$search}%")
                                   ->orWhere('title', 'like', "%{$search}%")
                                   ->orWhere('skills', 'like', "%{$search}%")
                                   ->orWhere('city', 'like', "%{$search}%");
                  });
            });
        }

        // Location filter
        if ($request->filled('location')) {
            $query->whereHas('candidateProfile', function($profileQuery) use ($request) {
                $profileQuery->where('city', 'like', "%{$request->location}%");
            });
        }

        // Skills filter
        if ($request->filled('skills')) {
            $query->whereHas('candidateProfile', function($profileQuery) use ($request) {
                $profileQuery->where('skills', 'like', "%{$request->skills}%");
            });
        }

        // Experience filter
        if ($request->filled('experience')) {
            $query->whereHas('candidateProfile', function($profileQuery) use ($request) {
                $profileQuery->where('experience_years', 'like', "%{$request->experience}%");
            });
        }

        $candidates = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Get candidate count for stats
        $candidateCount = User::where('user_type', 'candidate')
            ->whereHas('candidateProfile')
            ->count();

        // Handle AJAX load more request
        if ($request->ajax()) {
            return response()->json([
                'html' => view('companies.candidates-partial', compact('candidates'))->render(),
                'has_more' => $candidates->hasMorePages(),
                'next_page' => $candidates->currentPage() + 1
            ]);
        }

        return view('companies.index', compact('candidates', 'candidateCount'));
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

    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|min:10|max:1000',
        ]);

        $recruiter = auth()->user();
        $candidate = User::where('user_type', 'candidate')->findOrFail($id);

        if ($recruiter->user_type !== 'recruiter') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

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