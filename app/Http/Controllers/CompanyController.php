<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::where('is_active', true)
            ->withCount('jobs');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('industry', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Location filter
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Size filter
        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        $companies = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('companies.index', compact('companies'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $companies = Company::where('is_active', true)
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('industry', 'like', "%{$query}%")
                  ->orWhere('location', 'like', "%{$query}%");
            })
            ->limit(8)
            ->get(['id', 'name', 'slug', 'industry', 'location']);

        return response()->json($companies);
    }

    public function show(Company $company)
    {
        // Ensure the company is active
        if (!$company->is_active) {
            abort(404);
        }

        // Get company jobs
        $company->load(['jobs' => function($query) {
            $query->where('status', 'published')
                  ->orderBy('created_at', 'desc');
        }]);

        return view('companies.show', compact('company'));
    }
}