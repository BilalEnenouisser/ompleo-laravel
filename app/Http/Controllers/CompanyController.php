<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Services\FileUploadService;
use App\Http\Requests\StoreCompanyRequest;

class CompanyController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Display a listing of companies
     */
    public function index(Request $request)
    {
        $query = Company::active()->withCount('jobs');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('industry', 'like', "%{$search}%");
            });
        }

        // Industry filter
        if ($request->filled('industry')) {
            $query->where('industry', $request->industry);
        }

        $companies = $query->orderBy('name')->paginate(12);

        return view('companies.index', compact('companies'));
    }

    /**
     * Display the specified company
     */
    public function show(Company $company)
    {
        $company->load(['jobs' => function($query) {
            $query->published()->orderBy('created_at', 'desc');
        }]);

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for creating a new company (Admin only)
     */
    public function create()
    {
        $this->authorize('create', Company::class);
        
        return view('companies.create');
    }

    /**
     * Store a newly created company
     */
    public function store(StoreCompanyRequest $request)
    {
        $this->authorize('create', Company::class);

        try {
            $data = $request->validated();

            // Upload logo if provided
            if ($request->hasFile('logo')) {
                $data['logo'] = $this->fileUploadService->uploadLogo($request->file('logo'));
            }

            $company = Company::create($data);

            return redirect()->route('companies.show', $company)
                ->with('success', 'Société créée avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the company
     */
    public function edit(Company $company)
    {
        $this->authorize('update', $company);
        
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified company
     */
    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'size' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $data = $request->only([
                'name', 'description', 'website', 'size', 'industry', 'location'
            ]);

            // Upload new logo if provided
            if ($request->hasFile('logo')) {
                // Delete old logo
                if ($company->logo) {
                    $this->fileUploadService->deleteFile($company->logo);
                }
                $data['logo'] = $this->fileUploadService->uploadLogo($request->file('logo'));
            }

            $company->update($data);

            return redirect()->route('companies.show', $company)
                ->with('success', 'Société mise à jour avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified company
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        try {
            // Delete logo if exists
            if ($company->logo) {
                $this->fileUploadService->deleteFile($company->logo);
            }

            $company->delete();

            return redirect()->route('companies.index')
                ->with('success', 'Société supprimée avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }
}
