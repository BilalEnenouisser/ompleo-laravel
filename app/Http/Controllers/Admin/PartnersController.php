<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PartnersController extends Controller
{
    public function __construct()
    {
        $this->authorize('scanner-pass');
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of partners
     */
    public function index()
    {
        $this->authorize('scanner-pass');
        try {
            $partners = Partner::orderBy('sort_order')->orderBy('name')->get();
            return view('dashboard.admin.partners', compact('partners'));
        } catch (\Exception $e) {
            $partners = collect();
            return view('dashboard.admin.partners', compact('partners'));
        }
    }

    /**
     * Store a newly created partner
     */
    public function store(Request $request)
    {
        $this->authorize('scanner-pass'); if (!auth()->check()) { return api_json([ 'success' => false, 'error' => 'Non authentifié' ], 401); } try { $request->validate([ 'name' => 'required|string|max:255', 'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048', 'website' => 'nullable|url|max:255', 'description' => 'nullable|string|max:1000', 'is_featured' => 'nullable|boolean' ]); } catch (\Illuminate\Validation\ValidationException $e) { return api_json([ 'success' => false, 'error' => 'Validation failed: ' . implode(', ', $e->errors()) ], 422); } try { $logoPath = null; if ($request->hasFile('logo')) { $logo = $request->file('logo'); $logoName = Str::slug($request->name) . '_' . time() . '.' . $logo->getClientOriginalExtension(); $logoPath = $logo->storeAs('partners', $logoName, 'public'); if (!$logoPath) { return api_json([ 'success' => false, 'error' => 'Erreur lors de l\'upload du logo' ], 500); } } else { return api_json([ 'success' => false, 'error' => 'Logo requis' ], 422); } $partner = Partner::create([ 'name' => $request->name, 'logo' => $logoPath, 'website' => $request->website, 'description' => $request->description, 'is_featured' => $request->boolean('is_featured'), 'sort_order' => Partner::max('sort_order') + 1 ]); return api_json([ 'success' => true, 'message' => 'Partenaire créé avec succès!', 'partner' => $partner ]); } catch (\Exception $e) { return api_json([ 'success' => false, 'error' => 'Erreur lors de la création du partenaire: ' . $e->getMessage() ], 500); }
    }

    /**
     * Display the specified partner
     */
    public function show($id)
    {
        $this->authorize('scanner-pass');
        $partner = Partner::findOrFail($id);
        
        // Always return JSON for AJAX requests
        return api_json($partner);
    }

    /**
     * Show the form for editing the specified partner
     */
    public function edit($id)
    {
        $this->authorize('scanner-pass');
        $partner = Partner::findOrFail($id);
        return view('dashboard.admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified partner
     */
    public function update(Request $request, $id)
    {
        $this->authorize('scanner-pass'); if (!auth()->check()) { return api_json([ 'success' => false, 'error' => 'Non authentifié' ], 401); } try { $request->validate([ 'name' => 'required|string|max:255', 'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', 'website' => 'nullable|url|max:255', 'description' => 'nullable|string|max:1000', 'is_featured' => 'nullable|boolean' ]); } catch (\Illuminate\Validation\ValidationException $e) { return api_json([ 'success' => false, 'error' => 'Validation failed: ' . implode(', ', $e->errors()) ], 422); } try { $partner = Partner::findOrFail($id); if ($request->hasFile('logo')) { $logo = $request->file('logo'); $logoName = Str::slug($request->name) . '_' . time() . '.' . $logo->getClientOriginalExtension(); $logoPath = $logo->storeAs('partners', $logoName, 'public'); $partner->logo = $logoPath; } $partner->update([ 'name' => $request->name, 'website' => $request->website, 'description' => $request->description, 'is_featured' => $request->boolean('is_featured') ]); return api_json([ 'success' => true, 'message' => 'Partenaire mis à jour avec succès!', 'partner' => $partner ]); } catch (\Exception $e) { return api_json([ 'success' => false, 'error' => 'Erreur lors de la mise à jour du partenaire: ' . $e->getMessage() ], 500); }
    }

    /**
     * Remove the specified partner
     */
    public function destroy($id)
    {
        $this->authorize('scanner-pass');
        // Check if user is authenticated
        if (!auth()->check()) {
            return api_json([
                'success' => false,
                'error' => 'Non authentifié'
            ], 401);
        }
        
        try {
            $partner = Partner::findOrFail($id);
            $partner->delete();
            
            return api_json([
                'success' => true,
                'message' => 'Partenaire supprimé avec succès!'
            ]);
        } catch (\Exception $e) {
            return api_json([
                'success' => false,
                'error' => 'Erreur lors de la suppression du partenaire: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle featured status of a partner
     */
    public function toggleFeatured($id)
    {
        $this->authorize('scanner-pass');
        try {
            $partner = Partner::findOrFail($id);
            $partner->is_featured = !$partner->is_featured;
            $partner->save();

            return api_json([
                'success' => true,
                'message' => $partner->is_featured ? 'Partenaire mis en avant' : 'Partenaire retiré des partenaires mis en avant',
                'is_featured' => $partner->is_featured
            ]);
        } catch (\Exception $e) {
            return api_json([
                'success' => false,
                'error' => 'Erreur lors de la modification: ' . $e->getMessage()
            ], 500);
        }
    }
}