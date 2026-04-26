<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CandidateProfile;
use Illuminate\Http\Request;

class CandidatesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'recruiter']);
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        
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
                                   ->orWhere('skills', 'like', "%{$search}%")
                                   ->orWhere('city', 'like', "%{$search}%");
                  });
            });
        }
        
        // Apply location filter
        if ($request->filled('location')) {
            $query->whereHas('candidateProfile', function($profileQuery) use ($request) {
                $profileQuery->where('city', 'like', "%{$request->location}%");
            });
        }
        
        // Apply experience filter
        if ($request->filled('experience')) {
            $query->whereHas('candidateProfile', function($profileQuery) use ($request) {
                $profileQuery->where('experience', 'like', "%{$request->experience}%");
            });
        }
        
        // Apply skills filter
        if ($request->filled('skills')) {
            $query->whereHas('candidateProfile', function($profileQuery) use ($request) {
                $profileQuery->where('skills', 'like', "%{$request->skills}%");
            });
        }
        
        // Apply sorting
        $sortBy = $request->get('sort', 'recent');
        switch ($sortBy) {
            case 'recent':
                $query->orderBy('created_at', 'desc');
                break;
            case 'rating':
                $query->orderBy('created_at', 'desc'); // We don't have rating system yet
                break;
            case 'experience':
                $query->orderBy('created_at', 'desc'); // We can enhance this later
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $candidates = $query->paginate(12);
        
        // Get total count for display
        $totalCandidates = User::where('user_type', 'candidate')
            ->whereHas('candidateProfile')
            ->count();
        
        return view('dashboard.recruiter.candidates', compact('candidates', 'totalCandidates'));
    }
}
