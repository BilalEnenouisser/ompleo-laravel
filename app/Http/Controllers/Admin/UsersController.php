<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->user_type !== 'admin') {
                abort(403, 'Accès non autorisé');
            }
            return $next($request);
        });
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        try {
            
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|max:20',
                'city' => 'required|string|max:100',
                'user_type' => 'required|in:candidate,recruiter,admin',
                'status' => 'required|in:active,suspended,pending',
                'password' => 'required|string|min:8',
                'company_name' => 'nullable|string|max:255',
            ]);


            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => $request->user_type,
                'email_verified_at' => now(), // Auto-verify for admin-created users
            ]);


            // Create profile based on user type
            if ($request->user_type === 'candidate') {
                $profile = $user->candidateProfile()->create([
                    'phone' => $request->phone,
                    'city' => $request->city,
                    'status' => $request->status,
                ]);
            } elseif ($request->user_type === 'recruiter') {
                // Validate company name for recruiters
                if (empty($request->company_name)) {
                    return redirect()->back()->with('error', 'Le nom de l\'entreprise est requis pour les recruteurs.')->withInput();
                }
                
                // Create or find company
                $company = \App\Models\Company::firstOrCreate(
                    ['name' => $request->company_name],
                    ['description' => 'Entreprise ajoutée par l\'administrateur']
                );
                
                $profile = $user->recruiterProfile()->create([
                    'phone' => $request->phone,
                    'city' => $request->city,
                    'status' => $request->status,
                    'company_id' => $company->id,
                ]);
            }

            return redirect()->route('admin.users')->with('success', 'Utilisateur créé avec succès!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création de l\'utilisateur: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $query = User::with(['candidateProfile', 'recruiterProfile.company']);

        // Filter by user type
        if ($request->has('user_type') && $request->user_type !== '') {
            $query->where('user_type', $request->user_type);
        }

        // Search by name or email
        if ($request->has('search') && $request->search !== '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->whereHas('candidateProfile', function($q) use ($request) {
                $q->where('status', $request->status);
            })->orWhereHas('recruiterProfile', function($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(7);
        
        
        // Statistics
        $stats = [
            'total_users' => User::count(),
            'candidates' => User::where('user_type', 'candidate')->count(),
            'recruiters' => User::where('user_type', 'recruiter')->count(),
            'admins' => User::where('user_type', 'admin')->count(),
            'certified' => User::where('email_verified_at', '!=', null)->count(), // Use email_verified_at instead
        ];

        return view('dashboard.admin.users', compact('users', 'stats'));
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        $user->load(['candidateProfile', 'recruiterProfile.company', 'applications.job.company', 'jobs.company']);
        
        // Check if this is an API request (for modal)
        if (request()->wantsJson() || request()->ajax()) {
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->candidateProfile?->phone ?? $user->recruiterProfile?->phone,
            'city' => $user->candidateProfile?->city ?? $user->recruiterProfile?->city,
            'user_type' => $user->user_type,
            'status' => $user->candidateProfile?->status ?? $user->recruiterProfile?->status ?? 'active',
            'company_name' => $user->recruiterProfile?->company?->name,
            'avatar' => $user->candidateProfile?->avatar ? Storage::url($user->candidateProfile->avatar) : ($user->recruiterProfile?->avatar ? Storage::url($user->recruiterProfile->avatar) : null),
            'created_at' => $user->created_at->format('d/m/Y H:i'),
            'updated_at' => $user->updated_at->format('d/m/Y H:i'),
            'email_verified_at' => $user->email_verified_at?->format('d/m/Y H:i'),
        ]);
        }
        
        return view('dashboard.admin.user-detail', compact('user'));
    }

    /**
     * Show the form for editing the user
     */
    public function edit(User $user)
    {
        $companies = Company::all();
        return view('dashboard.admin.user-edit', compact('user', 'companies'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'required|string|max:20',
                'city' => 'required|string|max:100',
                'user_type' => 'required|in:candidate,recruiter,admin',
                'status' => 'required|in:active,suspended,pending',
                'company_name' => 'nullable|string|max:255',
                'password' => 'nullable|string|min:8',
            ]);

            // Update user
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'user_type' => $request->user_type,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->update($userData);

            // Update profile based on user type
            if ($request->user_type === 'candidate') {
                $profile = $user->candidateProfile;
                if ($profile) {
                    $profile->update([
                        'phone' => $request->phone,
                        'city' => $request->city,
                        'status' => $request->status,
                    ]);
                } else {
                    $user->candidateProfile()->create([
                        'phone' => $request->phone,
                        'city' => $request->city,
                        'status' => $request->status,
                    ]);
                }
            } elseif ($request->user_type === 'recruiter') {
                if (empty($request->company_name)) {
                    if (request()->wantsJson() || request()->ajax()) {
                        return response()->json(['success' => false, 'message' => 'Le nom de l\'entreprise est requis pour les recruteurs.'], 400);
                    }
                    return redirect()->back()->with('error', 'Le nom de l\'entreprise est requis pour les recruteurs.')->withInput();
                }
                
                $company = \App\Models\Company::firstOrCreate(
                    ['name' => $request->company_name],
                    ['description' => 'Entreprise mise à jour par l\'administrateur']
                );
                
                $profile = $user->recruiterProfile;
                if ($profile) {
                    $profile->update([
                        'phone' => $request->phone,
                        'city' => $request->city,
                        'status' => $request->status,
                        'company_id' => $company->id,
                    ]);
                } else {
                    $user->recruiterProfile()->create([
                        'phone' => $request->phone,
                        'city' => $request->city,
                        'status' => $request->status,
                        'company_id' => $company->id,
                    ]);
                }
            }

            // Check if this is an AJAX request (for modal)
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json(['success' => true, 'message' => 'Utilisateur mis à jour avec succès!']);
            }

            return redirect()->route('admin.users.show', $user)->with('success', 'Utilisateur mis à jour avec succès!');
            
        } catch (\Exception $e) {
            
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Erreur lors de la mise à jour: ' . $e->getMessage()], 500);
            }
            
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        try {
            // Prevent admin from deleting themselves
            if ($user->id === Auth::id()) {
                if (request()->wantsJson() || request()->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Vous ne pouvez pas supprimer votre propre compte.'], 403);
                }
                return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
            }

            $user->delete();

            // Check if this is an AJAX request (for modal)
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json(['success' => true, 'message' => 'Utilisateur supprimé avec succès!']);
            }

            return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès!');
            
        } catch (\Exception $e) {
            
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Erreur lors de la suppression: ' . $e->getMessage()], 500);
            }
            
            return redirect()->back()->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }


}
