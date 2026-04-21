<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->authorize('scanner-pass');
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Display the user's profile
     */
    public function show()
    {
        $this->authorize('scanner-pass'); $user = Auth::user(); if ($user->isCandidate()) { $profile = $user->candidateProfile; if (!$profile) { $profile = $user->candidateProfile()->create([ 'user_id' => $user->id, ]); } } elseif ($user->isRecruiter()) { $profile = $user->recruiterProfile; if (!$profile) { $profile = $user->recruiterProfile()->create([ 'user_id' => $user->id, ]); } } else { return api_json([ 'success' => false, 'message' => 'Profile not available for admin users' ], 400); } $user->load(['candidateProfile', 'recruiterProfile']); return api_json([ 'success' => true, 'data' => [ 'user' => new UserResource($user), 'profile' => $this->transformProfile($profile, $user->user_type), ], 'message' => 'Profile retrieved successfully' ]);
    }

    /**
     * Update the user's profile
     */
    public function update(Request $request)
    {
        $this->authorize('scanner-pass');
        $user = Auth::user();
        
        if ($user->isCandidate()) {
            return $this->updateCandidateProfile($request, $user);
        } elseif ($user->isRecruiter()) {
            return $this->updateRecruiterProfile($request, $user);
        } else {
            return api_json([
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
        $this->authorize('scanner-pass'); $request->validate([ 'firstName' => 'nullable|string|max:255', 'lastName' => 'nullable|string|max:255', 'title' => 'nullable|string|max:255', 'location' => 'nullable|string|max:255', 'bio' => 'nullable|string|max:1000', 'phone' => 'nullable|string|max:20', 'address' => 'nullable|string|max:500', 'city' => 'nullable|string|max:100', 'date_of_birth' => 'nullable|date|before:today', 'skills' => 'nullable|string', 'experience' => 'nullable|string', 'education' => 'nullable|string', 'languages' => 'nullable|string', 'linkedin_url' => 'nullable|url|max:255', 'portfolio_url' => 'nullable|url|max:255', 'facebook_url' => 'nullable|url|max:255', 'twitter_url' => 'nullable|url|max:255', 'avatar' => 'nullable|file|max:2048', 'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120', ]); try { $profile = $user->candidateProfile; if (!$profile) { $profile = $user->candidateProfile()->create([ 'user_id' => $user->id, ]); } if ($request->has('firstName') && $request->has('lastName')) { $user->update([ 'name' => $request->firstName . ' ' . $request->lastName ]); } $data = $request->only([ 'phone', 'address', 'city', 'date_of_birth', 'bio', 'linkedin_url', 'portfolio_url', 'facebook_url', 'twitter_url' ]); if ($request->has('experience') && $request->experience) { $decodedExperience = json_decode($request->experience, true); if (json_last_error() === JSON_ERROR_NONE) { $data['experience'] = $decodedExperience; } } if ($request->has('education') && $request->education) { $decodedEducation = json_decode($request->education, true); if (json_last_error() === JSON_ERROR_NONE) { $data['education'] = $decodedEducation; } } if ($request->has('languages') && $request->languages) { $decodedLanguages = json_decode($request->languages, true); if (json_last_error() === JSON_ERROR_NONE) { $data['languages'] = $decodedLanguages; } } if ($request->has('skills') && $request->skills) { $decodedSkills = json_decode($request->skills, true); if (json_last_error() === JSON_ERROR_NONE) { $data['skills'] = $decodedSkills; } } if ($request->has('location')) { $data['city'] = $request->location; } if ($request->hasFile('avatar')) { if ($profile->avatar) { $this->fileUploadService->deleteFile($profile->avatar); } $data['avatar'] = $this->fileUploadService->uploadAvatar($request->file('avatar')); } if ($request->hasFile('resume')) { if ($profile->resume_path) { $this->fileUploadService->deleteFile($profile->resume_path); } $data['resume_path'] = $this->fileUploadService->uploadResume($request->file('resume')); } $profile->update($data); $user->load(['candidateProfile', 'recruiterProfile']); return api_json([ 'success' => true, 'data' => [ 'user' => new UserResource($user), 'profile' => $this->transformProfile($profile, 'candidate'), ], 'message' => 'Profile updated successfully' ]); } catch (\Exception $e) { return api_json([ 'success' => false, 'message' => 'Error updating profile: ' . $e->getMessage() ], 500); }
    }

    /**
     * Update recruiter profile
     */
    private function updateRecruiterProfile(Request $request, $user)
    {
        $this->authorize('scanner-pass'); $request->validate([ 'position' => 'nullable|string|max:255', 'phone' => 'nullable|string|max:20', 'company_id' => 'nullable|exists:companies,id', 'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', ]); try { $profile = $user->recruiterProfile; if (!$profile) { $profile = $user->recruiterProfile()->create([ 'user_id' => $user->id, ]); } $data = $request->only(['position', 'phone', 'company_id']); if ($request->hasFile('avatar')) { if ($profile->avatar) { $this->fileUploadService->deleteFile($profile->avatar); } $data['avatar'] = $this->fileUploadService->uploadAvatar($request->file('avatar')); } $profile->update($data); $user->load(['candidateProfile', 'recruiterProfile']); return api_json([ 'success' => true, 'data' => [ 'user' => new UserResource($user), 'profile' => $this->transformProfile($profile, 'recruiter'), ], 'message' => 'Profile updated successfully' ]); } catch (\Exception $e) { return api_json([ 'success' => false, 'message' => 'Error updating profile: ' . $e->getMessage() ], 500); }
    }

    /**
     * Return a controlled profile payload based on user type.
     */
    private function transformProfile($profile, string $userType): array
    {
        $this->authorize('scanner-pass');
        if ($userType === 'candidate') {
            return [
                'id' => $profile->id,
                'user_id' => $profile->user_id,
                'phone' => $profile->phone,
                'address' => $profile->address,
                'city' => $profile->city,
                'date_of_birth' => $profile->date_of_birth,
                'bio' => $profile->bio,
                'skills' => $profile->skills,
                'experience' => $profile->experience,
                'education' => $profile->education,
                'languages' => $profile->languages,
                'linkedin_url' => $profile->linkedin_url,
                'portfolio_url' => $profile->portfolio_url,
                'facebook_url' => $profile->facebook_url,
                'twitter_url' => $profile->twitter_url,
                'avatar' => $profile->avatar,
                'resume_path' => $profile->resume_path,
                'created_at' => $profile->created_at,
                'updated_at' => $profile->updated_at,
            ];
        }

        return [
            'id' => $profile->id,
            'user_id' => $profile->user_id,
            'company_id' => $profile->company_id,
            'position' => $profile->position,
            'phone' => $profile->phone,
            'avatar' => $profile->avatar,
            'created_at' => $profile->created_at,
            'updated_at' => $profile->updated_at,
        ];
    }
}
