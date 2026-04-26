<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->user_type !== 'recruiter') {
                abort(403, 'Access denied');
            }
            return $next($request);
        });
    }

    /**
     * Display the settings page.
     */
    public function index()
    {
        $user = Auth::user();
        $profile = $user->recruiterProfile;
        
        return view('dashboard.recruiter.settings', compact('user', 'profile'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->recruiterProfile;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'phone' => 'nullable|string|max:20',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be valid.',
            'email.unique' => 'This email is already taken.',
            'password.confirmed' => 'Passwords do not match.',
            'password.min' => 'Password must be at least 8 characters.',
        ]);

        try {
            // Update user information
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            // Update profile contact information
            if ($profile) {
                $profile->update([
                    'phone' => $request->phone,
                ]);
            } else {
                // Create profile if it doesn't exist
                $user->recruiterProfile()->create([
                    'phone' => $request->phone,
                ]);
            }

            return redirect()->route('recruiter.settings')
                ->with('success', 'Paramètres mis à jour avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating settings: ' . $e->getMessage());
        }
    }
}
