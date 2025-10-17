<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PartnersController extends Controller
{
    /**
     * Display a listing of partners
     */
    public function index()
    {
        try {
            $partners = Partner::orderBy('sort_order')->orderBy('name')->get();
            \Log::info('Partners loaded successfully: ' . $partners->count());
            return view('dashboard.admin.partners', compact('partners'));
        } catch (\Exception $e) {
            \Log::error('Error loading partners: ' . $e->getMessage());
            $partners = collect();
            return view('dashboard.admin.partners', compact('partners'));
        }
    }

    /**
     * Store a newly created partner
     */
    public function store(Request $request)
    {
        \Log::info('Partner store request received', [
            'name' => $request->name,
            'has_logo' => $request->hasFile('logo'),
            'website' => $request->website,
            'description' => $request->description,
            'is_featured' => $request->is_featured
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'is_featured' => 'nullable|boolean'
        ]);

        try {
            // Handle logo upload
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoName = Str::slug($request->name) . '_' . time() . '.' . $logo->getClientOriginalExtension();
                $logoPath = $logo->storeAs('partners', $logoName, 'public');
                \Log::info('Logo stored at: ' . $logoPath);
            }

            $partner = Partner::create([
                'name' => $request->name,
                'logo' => $logoPath,
                'website' => $request->website,
                'description' => $request->description,
                'is_featured' => $request->has('is_featured') ? $request->boolean('is_featured') : false,
                'sort_order' => Partner::max('sort_order') + 1
            ]);

            \Log::info('Partner created successfully with ID: ' . $partner->id);

            return response()->json([
                'success' => true,
                'message' => 'Partenaire ajouté avec succès',
                'partner' => $partner
            ]);
        } catch (\Exception $e) {
            \Log::error('Partner creation error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json(['error' => 'Erreur lors de la création du partenaire: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified partner
     */
    public function show($id)
    {
        $partner = Partner::findOrFail($id);
        return response()->json($partner);
    }

    /**
     * Update the specified partner
     */
    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'is_featured' => 'boolean'
        ]);

        try {
            $data = [
                'name' => $request->name,
                'website' => $request->website,
                'description' => $request->description,
                'is_featured' => $request->boolean('is_featured')
            ];

            // Handle logo upload if new logo provided
            if ($request->hasFile('logo')) {
                // Delete old logo
                if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                    Storage::disk('public')->delete($partner->logo);
                }
                
                $logo = $request->file('logo');
                $logoName = Str::slug($request->name) . '_' . time() . '.' . $logo->getClientOriginalExtension();
                $data['logo'] = $logo->storeAs('partners', $logoName, 'public');
            }

            $partner->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Partenaire modifié avec succès',
                'partner' => $partner
            ]);
        } catch (\Exception $e) {
            \Log::error('Partner update error: ' . $e->getMessage());
            
            return response()->json(['error' => 'Erreur lors de la modification du partenaire'], 500);
        }
    }

    /**
     * Remove the specified partner
     */
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        
        try {
            // Delete logo file
            if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }
            
            $partner->delete();

            return response()->json([
                'success' => true,
                'message' => 'Partenaire supprimé avec succès'
            ]);
        } catch (\Exception $e) {
            \Log::error('Partner deletion error: ' . $e->getMessage());
            
            return response()->json(['error' => 'Erreur lors de la suppression du partenaire'], 500);
        }
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->update(['is_featured' => !$partner->is_featured]);
        
        return response()->json([
            'success' => true,
            'is_featured' => $partner->is_featured,
            'message' => $partner->is_featured ? 'Partenaire mis en avant' : 'Partenaire retiré de la mise en avant'
        ]);
    }
}