<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CandidateProfile;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->user_type !== 'candidate') {
                abort(403, 'Accès non autorisé');
            }
            return $next($request);
        });
    }

    /**
     * Display the candidate profile
     */
    public function show()
    {
        $user = Auth::user();
        $profile = $user->candidateProfile;
        
        // If no profile exists, create one
        if (!$profile) {
            $profile = CandidateProfile::create([
                'user_id' => $user->id,
            ]);
        }
        
        return view('dashboard.candidate.profile', compact('user', 'profile'));
    }

    /**
     * Update the candidate profile
     */
    public function update(Request $request)
    {
        \Log::info('Profile update request received', [
            'user_id' => Auth::id(),
            'request_data' => $request->all()
        ]);
        
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ], [
            'firstName.required' => 'Le prénom est requis.',
            'lastName.required' => 'Le nom est requis.',
            'bio.max' => 'La biographie ne doit pas dépasser 1000 caractères.',
            'phone.max' => 'Le téléphone ne doit pas dépasser 20 caractères.',
            'linkedin_url.url' => 'L\'URL LinkedIn doit être valide.',
            'portfolio_url.url' => 'L\'URL du portfolio doit être valide.',
        ]);

        try {
            \Log::info('Starting profile update process');
            
            // Update user name if provided
            if ($request->has('firstName') && $request->has('lastName')) {
                \Log::info('Updating user name', [
                    'firstName' => $request->firstName,
                    'lastName' => $request->lastName
                ]);
                $user->update([
                    'name' => $request->firstName . ' ' . $request->lastName
                ]);
                \Log::info('User name updated successfully');
            }

            $data = $request->only([
                'phone', 'address', 'city', 'date_of_birth', 'bio', 
                'linkedin_url', 'portfolio_url'
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
            if ($request->has('location')) {
                $data['city'] = $request->location;
            }

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Delete old avatar if exists
                if ($profile->avatar) {
                    $this->fileUploadService->deleteFile($profile->avatar);
                }
                $data['avatar'] = $this->fileUploadService->uploadAvatar($request->file('avatar'));
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
            \Log::info('Updating profile with data', ['data' => $data]);
            \Log::info('Raw request data', [
                'phone' => $request->phone,
                'phone_empty' => empty($request->phone),
                'skills' => $request->skills,
                'experience' => $request->experience,
                'education' => $request->education,
                'languages' => $request->languages,
                'experience_decoded' => json_decode($request->experience, true),
                'education_decoded' => json_decode($request->education, true)
            ]);
            $profile->update($data);
            \Log::info('Profile updated successfully');
            \Log::info('Updated profile phone:', ['phone' => $profile->fresh()->phone]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profil mis à jour avec succès!'
                ]);
            }

            return redirect()->route('candidate.profile')
                ->with('success', 'Profil mis à jour avec succès!');

        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
            \Log::error('Profile update error trace: ' . $e->getTraceAsString());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur lors de la mise à jour: ' . $e->getMessage(),
                    'debug' => $e->getMessage()
                ]);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
        }
    }
}
