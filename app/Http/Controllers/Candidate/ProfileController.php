<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CandidateProfile;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            // Allow candidates to access their own profile
            if (Auth::user()->user_type === 'candidate') {
                return $next($request);
            }
            // Allow recruiters and admins to view candidate profiles
            if (Auth::user()->user_type === 'recruiter' || Auth::user()->user_type === 'admin') {
                return $next($request);
            }
            abort(403, 'Accès non autorisé');
        });
    }

    /**
     * Display the candidate profile
     */
    public function show($user = null)
    {
        // If user parameter is provided, show that user's profile (for recruiters)
        if ($user) {
            $candidate = \App\Models\User::findOrFail($user);
            $profile = $candidate->candidateProfile;
            
            if (!$profile) {
                abort(404, 'Profil candidat non trouvé');
            }
            
            return view('dashboard.candidate.profile', compact('candidate', 'profile'));
        }
        
        // Otherwise, show current user's profile
        $candidate = Auth::user();
        $profile = $candidate->candidateProfile;
        
        // If no profile exists, create one
        if (!$profile) {
            $profile = CandidateProfile::create([
                'user_id' => $candidate->id,
            ]);
        }
        
        return view('dashboard.candidate.profile', compact('candidate', 'profile'));
    }

    /**
     * Display a public candidate profile (for recruiters)
     */
    public function publicShow($user)
    {
        // Check if user is recruiter or admin
        if (!Auth::check() || (Auth::user()->user_type !== 'recruiter' && Auth::user()->user_type !== 'admin')) {
            abort(403, 'Accès non autorisé');
        }

        $candidate = \App\Models\User::findOrFail($user);
        $profile = $candidate->candidateProfile;
        
        if (!$profile) {
            abort(404, 'Profil candidat non trouvé');
        }
        
        return view('dashboard.recruiter.candidate-profile', compact('candidate', 'profile'));
    }

    /**
     * Update the candidate profile
     */
    public function update(Request $request)
    {
        
        $user = Auth::user();
        $profile = $user->candidateProfile;
        
        // If no profile exists, create one
        if (!$profile) {
            $profile = CandidateProfile::create([
                'user_id' => $user->id,
            ]);
        }


        $request->validate([
            'firstName' => 'nullable|string|max:255',
            'lastName' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date|before:today',
            'skills' => 'nullable|string', // Changed from array to string to accept JSON
            'experience' => 'nullable|string', // Changed from array to string to accept JSON
            'education' => 'nullable|string', // Changed from array to string to accept JSON
            'languages' => 'nullable|string', // Added for languages JSON
            'linkedin_url' => 'nullable|url|max:255',
            'portfolio_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'avatar' => 'nullable|file|max:2048',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'experience_years' => 'nullable|string|max:50',
            'availability' => 'nullable|string|max:50',
        ], [
            'firstName.required' => 'Le prénom est requis.',
            'lastName.required' => 'Le nom est requis.',
            'bio.max' => 'La biographie ne doit pas dépasser 1000 caractères.',
            'phone.max' => 'Le téléphone ne doit pas dépasser 20 caractères.',
            'linkedin_url.url' => 'L\'URL LinkedIn doit être valide.',
            'portfolio_url.url' => 'L\'URL du portfolio doit être valide.',
            'avatar.file' => 'Le fichier avatar doit être un fichier valide.',
            'avatar.max' => 'Le fichier avatar ne doit pas dépasser 2MB.',
        ]);

        try {
            
            // Update user name if provided
            if ($request->has('firstName') && $request->has('lastName')) {
                $user->update([
                    'name' => $request->firstName . ' ' . $request->lastName
                ]);
            }

            $data = $request->only([
                'phone', 'address', 'city', 'date_of_birth', 'bio', 'title',
                'linkedin_url', 'portfolio_url', 'facebook_url', 'twitter_url',
                'experience_years', 'availability'
            ]);
            

            // Handle experience and education JSON data
            if ($request->has('experience') && $request->experience) {
                $decodedExperience = json_decode($request->experience, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $data['experience'] = $decodedExperience;
                }
            }
            
            if ($request->has('education') && $request->education) {
                $decodedEducation = json_decode($request->education, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $data['education'] = $decodedEducation;
                }
            }
            
            if ($request->has('languages') && $request->languages) {
                $decodedLanguages = json_decode($request->languages, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $data['languages'] = $decodedLanguages;
                }
            }
            
            if ($request->has('skills') && $request->skills) {
                $decodedSkills = json_decode($request->skills, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $data['skills'] = $decodedSkills;
                }
            }

            // Handle location field (maps to city)
            if ($request->has('location') && $request->location !== '' && $request->location !== null) {
                $data['city'] = $request->location;
            } elseif ($request->has('location') && ($request->location === '' || $request->location === null)) {
                // Allow empty city if explicitly set
                $data['city'] = null;
            }

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                try {
                    // Delete old avatar if exists
                    if ($profile->avatar) {
                        $this->fileUploadService->deleteFile($profile->avatar);
                    }
                    $data['avatar'] = $this->fileUploadService->uploadAvatar($request->file('avatar'));
                } catch (\Exception $e) {
                    throw new \Exception('Erreur lors de l\'upload de l\'avatar: ' . $e->getMessage());
                }
            }

            // Handle resume upload
            if ($request->hasFile('resume')) {
                // Delete old resume if exists
                if ($profile->resume_path) {
                    $this->fileUploadService->deleteFile($profile->resume_path);
                }
                $data['resume_path'] = $this->fileUploadService->uploadResume($request->file('resume'));
            }

            // Update profile
            $profile->update($data);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profil mis à jour avec succès!'
                ]);
            }

            return redirect()->route('candidate.profile')
                ->with('success', 'Profil mis à jour avec succès!');

        } catch (\Exception $e) {
            // Log the actual error for debugging
            \Log::error('Candidate profile update error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['avatar', 'resume'])
            ]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur lors de la mise à jour du profil: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
        }
    }
}
