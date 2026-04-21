<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->authorize('scanner-pass');
        $this->middleware('auth');
        $this->middleware('check.user.type:admin');
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Display the admin profile page.
     */
    public function show()
    {
        $this->authorize('scanner-pass');
        $user = Auth::user();
        return view('dashboard.admin.profile', compact('user'));
    }

    /**
     * Update the admin profile.
     */
    public function update(Request $request)
    {
        $this->authorize('scanner-pass'); $user = Auth::user(); $request->validate([ 'name' => 'required|string|max:255', 'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, 'password' => ['nullable', 'confirmed', Password::min(8)], 'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', ], [ 'name.required' => 'Le nom est requis.', 'email.required' => 'L\'email est requis.', 'email.email' => 'L\'email doit être valide.', 'email.unique' => 'Cet email est déjà utilisé.', 'password.confirmed' => 'Les mots de passe ne correspondent pas.', 'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.', 'avatar.image' => 'Le fichier doit être une image.', 'avatar.mimes' => 'L\'image doit être au format JPEG, PNG ou JPG.', 'avatar.max' => 'L\'image ne doit pas dépasser 2MB.', ]); try { $user->name = $request->name; $user->email = $request->email; if ($request->filled('password')) { $user->password = Hash::make($request->password); } if ($request->hasFile('avatar')) { try { if ($user->avatar) { $this->fileUploadService->deleteFile($user->avatar); } $user->avatar = $this->fileUploadService->uploadAvatar($request->file('avatar')); } catch (\Exception $e) { throw new \Exception('Erreur lors de l\'upload de l\'avatar: ' . $e->getMessage()); } } $user->save(); return redirect()->route('admin.profile') ->with('success', 'Profil mis à jour avec succès!'); } catch (\Exception $e) { return redirect()->back() ->withInput() ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage()); }
    }
}
