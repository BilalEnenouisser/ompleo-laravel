<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.user.type:recruiter');
    }

    public function show()
    {
        $user = Auth::user();
        
        // Ensure recruiter profile exists
        if (!$user->recruiterProfile) {
            $user->recruiterProfile()->create([
                'user_id' => $user->id,
                'position' => 'Recruteur',
                'phone' => null,
                'company_id' => null, // Will be set after company creation
            ]);
        }
        
        $company = $user->recruiterProfile->company ?? null;
        
        return view('dashboard.recruiter.company-profile', compact('company'));
    }

    public function update(Request $request)
    {
        // Debug: Log incoming request data
        \Log::info('Company profile update request:', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'industry' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        
        // Ensure recruiter profile exists
        if (!$user->recruiterProfile) {
            $user->recruiterProfile()->create([
                'user_id' => $user->id,
                'position' => 'Recruteur',
                'phone' => null,
                'company_id' => null, // Will be set after company creation
            ]);
        }
        
        $recruiterProfile = $user->recruiterProfile;

        // Get or create company
        $company = $recruiterProfile->company;
        if (!$company) {
            $company = new Company();
            $company->slug = \Str::slug($request->name);
        }

        // Update company data
        $company->name = $request->name;
        $company->description = $request->description;
        $company->industry = $request->industry;
        $company->location = $request->city;
        $company->size = $request->size;
        $company->is_active = true;

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo) {
                Storage::delete($company->logo);
            }
            
            $logoPath = $request->file('logo')->store('companies/logos', 'public');
            $company->logo = $logoPath;
        }

        $company->save();

        // Update recruiter profile company_id if not set
        if (!$recruiterProfile->company_id) {
            $recruiterProfile->company_id = $company->id;
            $recruiterProfile->save();
        }

        // Debug: Log the saved data
        \Log::info('Company saved:', [
            'id' => $company->id,
            'name' => $company->name,
            'industry' => $company->industry,
            'location' => $company->location,
            'size' => $company->size,
            'logo' => $company->logo,
        ]);

        return back()->with('success', 'Informations de l\'entreprise mises à jour avec succès!');
    }
}
