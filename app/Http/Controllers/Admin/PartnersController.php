<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
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
            }

            $partner = Partner::create([
                'name' => $request->name,
                'logo' => $logoPath,
                'website' => $request->website,
                'description' => $request->description,
                'is_featured' => $request->boolean('is_featured'),
                'sort_order' => Partner::max('sort_order') + 1
            ]);

            return redirect()->route('admin.partners')->with('success', 'Partenaire créé avec succès!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de la création du partenaire: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified partner
     */
    public function show($id)
    {
        $partner = Partner::findOrFail($id);
        return view('dashboard.admin.partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified partner
     */
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('dashboard.admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified partner
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'is_featured' => 'nullable|boolean'
        ]);

        try {
            $partner = Partner::findOrFail($id);
            
            // Handle logo upload if new logo is provided
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoName = Str::slug($request->name) . '_' . time() . '.' . $logo->getClientOriginalExtension();
                $logoPath = $logo->storeAs('partners', $logoName, 'public');
                $partner->logo = $logoPath;
            }

            $partner->update([
                'name' => $request->name,
                'website' => $request->website,
                'description' => $request->description,
                'is_featured' => $request->boolean('is_featured')
            ]);

            return redirect()->route('admin.partners')->with('success', 'Partenaire mis à jour avec succès!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de la mise à jour du partenaire: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified partner
     */
    public function destroy($id)
    {
        try {
            $partner = Partner::findOrFail($id);
            $partner->delete();
            
            return redirect()->route('admin.partners')->with('success', 'Partenaire supprimé avec succès!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de la suppression du partenaire: ' . $e->getMessage()]);
        }
    }
}