<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\FileUploadService;

class CompaniesController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->user_type !== 'admin') {
                abort(403, 'Accès non autorisé');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of companies
     */
    public function index(Request $request)
    {
        $query = Company::with(['recruiterProfiles.user', 'jobs']);

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Search by name
        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $companies = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Statistics
        $stats = [
            'total_companies' => Company::count(),
            'active_companies' => Company::where('is_active', true)->count(),
            'inactive_companies' => Company::where('is_active', false)->count(),
        ];

        return view('dashboard.admin.companies', compact('companies', 'stats'));
    }

    /**
     * Display the specified company
     */
    public function show(Company $company)
    {
        $company->load(['recruiterProfiles.user', 'jobs.applications', 'jobs.recruiter']);
        
        return view('dashboard.admin.company-detail', compact('company'));
    }

    /**
     * Show the form for creating a new company
     */
    public function create()
    {
        return view('dashboard.admin.company-create');
    }

    /**
     * Store a newly created company
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:companies',
            'description' => 'nullable|string|max:1000',
            'website' => 'nullable|url|max:255',
            'size' => 'nullable|string|max:50',
            'industry' => 'nullable|string|max:100',
            'specialisation' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer|min:0|max:50',
            'location' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->only([
            'name', 'description', 'website', 'size', 'industry', 'specialisation', 'years_experience', 'location', 'is_active'
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->fileUploadService->uploadLogo($request->file('logo'));
        }

        Company::create($data);

        return redirect()->route('admin.companies')->with('success', 'Entreprise créée avec succès!');
    }

    /**
     * Show the form for editing the company
     */
    public function edit(Company $company)
    {
        return view('dashboard.admin.company-edit', compact('company'));
    }

    /**
     * Update the specified company
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:companies,name,' . $company->id,
            'description' => 'nullable|string|max:1000',
            'website' => 'nullable|url|max:255',
            'size' => 'nullable|string|max:50',
            'industry' => 'nullable|string|max:100',
            'specialisation' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer|min:0|max:50',
            'location' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->only([
            'name', 'description', 'website', 'size', 'industry', 'specialisation', 'years_experience', 'location', 'is_active'
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo) {
                $this->fileUploadService->deleteFile($company->logo);
            }
            $data['logo'] = $this->fileUploadService->uploadLogo($request->file('logo'));
        }

        $company->update($data);

        return redirect()->route('admin.companies.show', $company)->with('success', 'Entreprise mise à jour avec succès!');
    }

    /**
     * Remove the specified company
     */
    public function destroy(Company $company)
    {
        // Delete logo if exists
        if ($company->logo) {
            $this->fileUploadService->deleteFile($company->logo);
        }

        $company->delete();

        return redirect()->route('admin.companies')->with('success', 'Entreprise supprimée avec succès!');
    }
}
