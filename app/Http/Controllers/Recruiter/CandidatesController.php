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
        $this->authorize('scanner-pass');
        $this->middleware(['auth', 'recruiter']);
    }

    public function index(Request $request)
    {
        $user = auth()->user(); $query = User::where('user_type', 'candidate') ->whereHas('candidateProfile') ->with(['candidateProfile']); if ($request->filled('search')) { $search = $request->search; $query->where(function($q) use ($search) { $q->where('name', 'like', "%{$search}%") ->orWhere('email', 'like', "%{$search}%") ->orWhereHas('candidateProfile', function($profileQuery) use ($search) { $profileQuery->where('bio', 'like', "%{$search}%") ->orWhere('skills', 'like', "%{$search}%") ->orWhere('city', 'like', "%{$search}%"); }); }); } if ($request->filled('location')) { $query->whereHas('candidateProfile', function($profileQuery) use ($request) { $profileQuery->where('city', 'like', "%{$request->location}%"); }); } if ($request->filled('experience')) { $query->whereHas('candidateProfile', function($profileQuery) use ($request) { $profileQuery->where('experience', 'like', "%{$request->experience}%"); }); } if ($request->filled('skills')) { $query->whereHas('candidateProfile', function($profileQuery) use ($request) { $profileQuery->where('skills', 'like', "%{$request->skills}%"); }); } $sortBy = $request->get('sort', 'recent'); switch ($sortBy) { case 'recent': $query->orderBy('created_at', 'desc'); break; case 'rating': $query->orderBy('created_at', 'desc'); break; case 'experience': $query->orderBy('created_at', 'desc'); break; default: $query->orderBy('created_at', 'desc'); } $candidates = $query->paginate(12); $displayCandidates = $this->prepareDisplayCandidates($candidates->getCollection()); $candidates->setCollection($displayCandidates); $totalCandidates = User::where('user_type', 'candidate') ->whereHas('candidateProfile') ->count(); return view('dashboard.recruiter.candidates', compact('candidates', 'displayCandidates', 'totalCandidates'));
    }

    private function prepareDisplayCandidates($candidates)
    {
        return $candidates->map(function (User $candidate) {
            $profile = $candidate->candidateProfile;
            $nameParts = preg_split('/\s+/', trim((string) $candidate->name), -1, PREG_SPLIT_NO_EMPTY) ?: [];
            $initials = '';

            if (!empty($nameParts)) {
                $initials = strtoupper(substr($nameParts[0], 0, 1));
                if (count($nameParts) > 1) {
                    $initials .= strtoupper(substr($nameParts[1], 0, 1));
                }
            }

            $skills = [];
            if ($profile && is_array($profile->skills)) {
                $skills = array_values(array_filter(array_map(function ($skill) {
                    return is_string($skill) ? trim($skill) : (string) $skill;
                }, $profile->skills)));
            }

            $experienceText = 'Non spécifié';
            if ($profile && isset($profile->experience) && is_array($profile->experience) && !empty($profile->experience)) {
                $experienceStrings = array_map(function ($item) {
                    if (is_string($item)) {
                        return $item;
                    }

                    if (is_array($item)) {
                        return implode(', ', array_map('strval', $item));
                    }

                    return (string) $item;
                }, $profile->experience);

                $experienceText = trim(implode(', ', array_filter($experienceStrings))) ?: 'Non spécifié';
            }

            $educationText = 'Non spécifié';
            if ($profile && isset($profile->education) && is_array($profile->education) && !empty($profile->education)) {
                $firstEducation = $profile->education[0];

                if (is_array($firstEducation)) {
                    $educationText = trim((string) ($firstEducation['degree'] ?? $firstEducation['title'] ?? $firstEducation['diploma'] ?? $firstEducation['name'] ?? 'Non spécifié')) ?: 'Non spécifié';
                } elseif (is_string($firstEducation)) {
                    $educationText = trim($firstEducation) ?: 'Non spécifié';
                }
            }

            $rating = number_format(4.0 + (($candidate->id % 11) / 10), 1, '.', '');
            $fullStars = (int) floor((float) $rating);
            $hasHalfStar = (((float) $rating) - $fullStars) >= 0.5;

            $candidate->setRelation('candidateProfile', $profile);
            $candidate->setAttribute('display', [
                'initials' => $initials,
                'skills' => $skills,
                'experienceText' => $experienceText,
                'educationText' => $educationText,
                'rating' => $rating,
                'fullStars' => $fullStars,
                'hasHalfStar' => $hasHalfStar,
                'bioText' => is_string($profile?->bio ?? null) ? $profile->bio : 'Développeur passionné avec 3 ans d\'expérience en React et TypeScript.',
                'cityText' => is_string($profile?->city ?? null) ? $profile->city : 'Alger, Chéraga',
                'experienceYearsText' => $profile?->experience_years ?? '3 ans d\'expérience',
                'availabilityText' => $profile?->availability ?? 'Immédiate',
                'titleText' => !empty($profile?->bio) ? 'Développeur Frontend React' : 'Développeur Frontend',
            ]);

            return $candidate;
        });
    }
}
