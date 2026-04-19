<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of companies (Public API)
     */
    public function index(Request $request)
    {
        $query = Company::where('is_active', true);

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

        // Filter by industry
        if ($request->filled('industry')) {
            $query->where('industry', 'like', "%{$request->industry}%");
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Filter by size
        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        // Sorting
        $sort = $request->get('sort', 'name');
        switch ($sort) {
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('name', 'asc');
                break;
        }

        $companies = $query->paginate($request->get('per_page', 12));

        return CompanyResource::collection($companies)
            ->additional([
                'success' => true,
                'message' => 'Companies retrieved successfully',
            ]);
    }

    /**
     * Display the specified company (Public API)
     */
    public function show(Company $company)
    {
        if (!$company->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found'
            ], 404);
        }

        // Load related data
        $company->load(['jobs' => function($query) {
            $query->where('status', 'published')->orderBy('created_at', 'desc');
        }]);

        return (new CompanyResource($company))
            ->additional([
                'success' => true,
                'message' => 'Company retrieved successfully',
            ]);
    }
}
