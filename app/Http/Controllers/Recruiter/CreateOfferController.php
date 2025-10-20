<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateOfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.user.type:recruiter');
    }

    public function show()
    {
        $user = Auth::user();
        $recruiterProfile = $user->recruiterProfile;
        $company = $recruiterProfile ? $recruiterProfile->company : null;
        
        return view('dashboard.recruiter.create-offer', compact('company'));
    }

    public function store(Request $request)
    {
        
        // Check if it's a draft save
        $isDraft = $request->has('save_draft');
        
        
        if ($isDraft) {
            // More relaxed validation for drafts
            $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'location' => 'nullable|string|max:255',
                'type' => 'nullable|string',
                'workType' => 'nullable|string',
                'salary_min' => 'nullable|numeric|min:0',
                'salary_max' => 'nullable|numeric|min:0',
                'expiryDate' => 'nullable|date',
                'responsibilities' => 'array',
                'requirements' => 'array',
                'benefits' => 'array',
                'skills' => 'array',
            ]);
        } else {
            // Full validation for publishing
            try {
                $request->validate([
                    'title' => 'required|string|max:255',
                    'description' => 'required|string',
                    'location' => 'required|string|max:255',
                    'type' => 'required|string',
                    'workType' => 'required|string',
                    'salary_min' => 'required|numeric|min:0',
                    'salary_max' => 'required|numeric|min:0',
                    'expiryDate' => 'required|date',
                    'responsibilities' => 'nullable|array',
                    'requirements' => 'nullable|array',
                    'benefits' => 'nullable|array',
                    'skills' => 'nullable|array',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                throw $e;
            }
        }

        $user = Auth::user();
        $recruiterProfile = $user->recruiterProfile;
        
        if (!$recruiterProfile || !$recruiterProfile->company) {
            return back()->with('error', 'Vous devez d\'abord configurer votre profil entreprise.');
        }

        $job = new Job();
        $job->company_id = $recruiterProfile->company_id;
        $job->recruiter_id = $user->id;
        $job->title = $request->title ?? 'Brouillon sans titre';
        $job->slug = Str::slug(($request->title ?? 'draft') . '-' . Str::random(5));
        $job->description = $request->description ?? '';
        $job->requirements = $request->requirements ?? [];
        $job->benefits = $request->benefits ?? [];
        $job->salary_min = $request->salary_min ?? 0;
        $job->salary_max = $request->salary_max ?? 0;
        $job->location = $request->location ?? '';
        $job->type = $request->type ?? 'CDI';
        $job->work_type = $request->workType ?? 'onsite';
        $job->tags = $request->skills ?? [];
        $job->status = $isDraft ? 'draft' : 'published';
        $job->application_deadline = $request->expiryDate;
        $job->is_featured = $request->has('featured');
        
        try {
            $job->save();
            
        } catch (\Exception $e) {
            throw $e;
        }

        if ($isDraft) {
            return redirect()->route('recruiter.jobs')->with('success', 'Brouillon sauvegardé avec succès!');
        } else {
            return redirect()->route('recruiter.jobs')->with('success', 'Offre d\'emploi publiée avec succès!');
        }
    }

    public function edit(Job $job)
    {
        // Check if the job belongs to the authenticated recruiter
        if ($job->recruiter_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this job.');
        }

        $user = Auth::user();
        $recruiterProfile = $user->recruiterProfile;
        $company = $recruiterProfile ? $recruiterProfile->company : null;
        
        return view('dashboard.recruiter.edit-offer', compact('job', 'company'));
    }

    public function update(Request $request, Job $job)
    {
        // Check if the job belongs to the authenticated recruiter
        if ($job->recruiter_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this job.');
        }

        // Check if it's a draft save
        $isDraft = $request->has('save_draft');
        
        if ($isDraft) {
            // More relaxed validation for drafts
            $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'location' => 'nullable|string|max:255',
                'type' => 'nullable|string',
                'workType' => 'nullable|string',
                'salary_min' => 'nullable|numeric|min:0',
                'salary_max' => 'nullable|numeric|min:0',
                'expiryDate' => 'nullable|date',
                'responsibilities' => 'array',
                'requirements' => 'array',
                'benefits' => 'array',
                'skills' => 'array',
            ]);
        } else {
            // Full validation for publishing
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'location' => 'required|string|max:255',
                'type' => 'required|string',
                'workType' => 'required|string',
                'salary_min' => 'required|numeric|min:0',
                'salary_max' => 'required|numeric|min:0',
                'expiryDate' => 'required|date',
                'responsibilities' => 'nullable|array',
                'requirements' => 'nullable|array',
                'benefits' => 'nullable|array',
                'skills' => 'nullable|array',
            ]);
        }

        $job->title = $request->title ?? $job->title;
        $job->description = $request->description ?? $job->description;
        $job->requirements = $request->requirements ?? $job->requirements;
        $job->benefits = $request->benefits ?? $job->benefits;
        $job->salary_min = $request->salary_min ?? $job->salary_min;
        $job->salary_max = $request->salary_max ?? $job->salary_max;
        $job->location = $request->location ?? $job->location;
        $job->type = $request->type ?? $job->type;
        $job->work_type = $request->workType ?? $job->work_type;
        $job->tags = $request->skills ?? $job->tags;
        $job->status = $isDraft ? 'draft' : 'published';
        $job->application_deadline = $request->expiryDate ?? $job->application_deadline;
        $job->is_featured = $request->has('featured');
        
        $job->save();

        if ($isDraft) {
            return redirect()->route('recruiter.jobs')->with('success', 'Brouillon mis à jour avec succès!');
        } else {
            return redirect()->route('recruiter.jobs')->with('success', 'Offre d\'emploi mise à jour avec succès!');
        }
    }
}
