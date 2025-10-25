<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCandidateProfileRequest;
use App\Http\Requests\UpdateRecruiterProfileRequest;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Display the user's profile
     */
    public function show()
    {
        $user = Auth::user();
        
        if ($user->isCandidate()) {
            $profile = $user->candidateProfile;
            if (!$profile) {
                $profile = $user->candidateProfile()->create([
                    'user_id' => $user->id,
                ]);
            }
        } elseif ($user->isRecruiter()) {
            $profile = $user->recruiterProfile;
            if (!$profile) {
                $profile = $user->recruiterProfile()->create([
                    'user_id' => $user->id,
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Profile not available for admin users'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'profile' => $profile
            ],
            'message' => 'Profile retrieved successfully'
        ]);
    }

    /**
     * Update the user's profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        if ($user->isCandidate()) {
            return $this->updateCandidateProfile($request, $user);
        } elseif ($user->isRecruiter()) {
            return $this->updateRecruiterProfile($request, $user);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Profile update not available for admin users'
            ], 400);
        }
    }

    /**
     * Update candidate profile
     */
    private function updateCandidateProfile(Request $request, $user)
    {
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
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
            'languages' => 'nullable|string',
            'linkedin_url' => 'nullable|url|max:255',
            'portfolio_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'avatar' => 'nullable|file|max:2048',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        try {
            $profile = $user->candidateProfile;
            
            if (!$profile) {
                $profile = $user->candidateProfile()->create([
                    'user_id' => $user->id,
                ]);
            }

            // Update user name if provided
            if ($request->has('firstName') && $request->has('lastName')) {
                $user->update([
                    'name' => $request->firstName . ' ' . $request->lastName
                ]);
            }

            $data = $request->only([
                'phone', 'address', 'city', 'date_of_birth', 'bio', 
                'linkedin_url', 'portfolio_url', 'facebook_url', 'twitter_url'
            ]);

            // Handle JSON data
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

            // Handle location field
            if ($request->has('location')) {
                $data['city'] = $request->location;
            }

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                if ($profile->avatar) {
                    $this->fileUploadService->deleteFile($profile->avatar);
                }
                $data['avatar'] = $this->fileUploadService->uploadAvatar($request->file('avatar'));
            }

            // Handle resume upload
            if ($request->hasFile('resume')) {
                if ($profile->resume_path) {
                    $this->fileUploadService->deleteFile($profile->resume_path);
                }
                $data['resume_path'] = $this->fileUploadService->uploadResume($request->file('resume'));
            }

            $profile->update($data);

            return response()->json([
                'success' => true,
                'data' => $profile,
                'message' => 'Profile updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating profile: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update recruiter profile
     */
    private function updateRecruiterProfile(Request $request, $user)
    {
        $request->validate([
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'company_id' => 'nullable|exists:companies,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $profile = $user->recruiterProfile;
            
            if (!$profile) {
                $profile = $user->recruiterProfile()->create([
                    'user_id' => $user->id,
                ]);
            }

            $data = $request->only(['position', 'phone', 'company_id']);

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                if ($profile->avatar) {
                    $this->fileUploadService->deleteFile($profile->avatar);
                }
                $data['avatar'] = $this->fileUploadService->uploadAvatar($request->file('avatar'));
            }

            $profile->update($data);

            return response()->json([
                'success' => true,
                'data' => $profile,
                'message' => 'Profile updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating profile: ' . $e->getMessage()
            ], 500);
        }
    }
}
