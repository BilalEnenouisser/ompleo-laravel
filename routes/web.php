<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LocaleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    // Redirect old register to signup choice
    Route::get('/register', function () {
        return redirect()->route('signup.choice');
    })->name('register');
    
    // Signup Choice Flow
    Route::get('/signup-choice', function () {
        return view('auth.signup-choice');
    })->name('signup.choice');
    
    Route::get('/signup-candidate', function () {
        return view('auth.signup-candidate');
    })->name('signup.candidate');
    
    Route::get('/signup-recruiter', function () {
        return view('auth.signup-recruiter');
    })->name('signup.recruiter');
    
    // Handle registration form submissions
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Recruiter Registration
    Route::get('/recruiter/register', function () {
        return view('auth.recruiter-register');
    })->name('recruiter.register');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.users');
    Route::post('/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}', [App\Http\Controllers\Admin\UsersController::class, 'show'])->name('admin.users.show');
    Route::put('/admin/users/{user}', [App\Http\Controllers\Admin\UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('admin.users.destroy');

// Test route for debugging dates
Route::get('/test-dates', function() {
    $user = App\Models\User::latest()->first();
    return response()->json([
        'user_name' => $user->name,
        'created_at' => $user->created_at,
        'updated_at' => $user->updated_at,
        'created_at_formatted' => $user->created_at->format('Y-m-d H:i:s'),
        'updated_at_formatted' => $user->updated_at->format('Y-m-d H:i:s'),
    ]);
});
    Route::get('/admin/jobs', function () {
        return view('dashboard.admin.jobs');
    })->name('admin.jobs');
    Route::get('/admin/partners', function () {
        return view('dashboard.admin.partners');
    })->name('admin.partners');
                Route::get('/admin/blog', function () {
                    return view('dashboard.admin.blog');
                })->name('admin.blog');
Route::get('/admin/notifications', function () {
    return view('dashboard.admin.notifications');
})->name('admin.notifications');

Route::get('/admin/reports', function () {
    return view('dashboard.admin.reports');
})->name('admin.reports');

Route::get('/admin/payments', function () {
    return view('dashboard.admin.payments');
})->name('admin.payments');

Route::get('/test-jobs', function() {
    echo "Total jobs: " . \App\Models\Job::count() . "\n";
    $job = \App\Models\Job::first();
    if ($job) {
        echo "First job: " . $job->title . "\n";
        echo "Company ID: " . $job->company_id . "\n";
        echo "Recruiter ID: " . $job->recruiter_id . "\n";
        
        // Test relationships
        try {
            $company = $job->company;
            echo "Company: " . ($company ? $company->name : 'NULL') . "\n";
        } catch (Exception $e) {
            echo "Company relationship error: " . $e->getMessage() . "\n";
        }
        
        try {
            $recruiter = $job->recruiter;
            echo "Recruiter: " . ($recruiter ? $recruiter->name : 'NULL') . "\n";
        } catch (Exception $e) {
            echo "Recruiter relationship error: " . $e->getMessage() . "\n";
        }
    }
});

Route::get('/admin/blog/editor', function () {
    return view('dashboard.admin.blog-editor');
})->name('admin.blog.editor');
    Route::get('/candidate/dashboard', [App\Http\Controllers\Candidate\DashboardController::class, 'index'])->name('candidate.dashboard');
    Route::get('/candidate/profile', [App\Http\Controllers\Candidate\ProfileController::class, 'show'])->name('candidate.profile');
    Route::put('/candidate/profile', [App\Http\Controllers\Candidate\ProfileController::class, 'update'])->name('candidate.profile.update');
    
    // Test route for debugging
    Route::post('/test-profile-update', function(\Illuminate\Http\Request $request) {
        \Log::info('Test profile update called', $request->all());
        return response()->json(['success' => true, 'message' => 'Test successful']);
    });
});

// Password Reset Routes
Route::get('/password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');

Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// Jobs Routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'check.user.type:admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Jobs Management
    Route::get('/jobs', [App\Http\Controllers\Admin\JobsController::class, 'index'])->name('jobs');
    Route::get('/jobs/{job}', [App\Http\Controllers\Admin\JobsController::class, 'show'])->name('jobs.show');
    Route::put('/jobs/{job}', [App\Http\Controllers\Admin\JobsController::class, 'update'])->name('jobs.update');
    Route::patch('/jobs/{job}/status', [App\Http\Controllers\Admin\JobsController::class, 'updateStatus'])->name('jobs.updateStatus');
    Route::delete('/jobs/{job}', [App\Http\Controllers\Admin\JobsController::class, 'destroy'])->name('jobs.destroy');
    
    // Users Management
    Route::get('/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users');
    Route::get('/users/{user}', [App\Http\Controllers\Admin\UsersController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [App\Http\Controllers\Admin\UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('users.destroy');
    
    // Companies Management
    Route::get('/companies', [App\Http\Controllers\Admin\CompaniesController::class, 'index'])->name('companies');
    Route::get('/companies/create', [App\Http\Controllers\Admin\CompaniesController::class, 'create'])->name('companies.create');
    Route::post('/companies', [App\Http\Controllers\Admin\CompaniesController::class, 'store'])->name('companies.store');
    Route::get('/companies/{company}', [App\Http\Controllers\Admin\CompaniesController::class, 'show'])->name('companies.show');
    Route::get('/companies/{company}/edit', [App\Http\Controllers\Admin\CompaniesController::class, 'edit'])->name('companies.edit');
    Route::patch('/companies/{company}', [App\Http\Controllers\Admin\CompaniesController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{company}', [App\Http\Controllers\Admin\CompaniesController::class, 'destroy'])->name('companies.destroy');
});

// Applications Routes
Route::middleware('auth')->group(function () {
    Route::get('/applications', [App\Http\Controllers\ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/jobs/{job}/apply', [App\Http\Controllers\ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications', [App\Http\Controllers\ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{application}', [App\Http\Controllers\ApplicationController::class, 'show'])->name('applications.show');
    Route::put('/applications/{application}/status', [App\Http\Controllers\ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
    Route::delete('/applications/{application}', [App\Http\Controllers\ApplicationController::class, 'withdraw'])->name('applications.withdraw');
});

// Companies Routes
Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{company}', [App\Http\Controllers\CompanyController::class, 'show'])->name('companies.show');

// Public Jobs Routes
Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [App\Http\Controllers\JobController::class, 'show'])->name('jobs.show');

Route::middleware('auth')->group(function () {
    Route::get('/companies/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{company}/edit', [App\Http\Controllers\CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{company}', [App\Http\Controllers\CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{company}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('companies.destroy');
});

// About Page
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Contact Page
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', function () {
    // Handle contact form submission
    return redirect()->back()->with('success', 'Message envoyé avec succès! Nous vous répondrons dans les plus brefs délais.');
})->name('contact.submit');

// Blog Routes
Route::get('/blog', function () {
    return view('blog.index');
})->name('blog.index');

Route::get('/blog/{post}', function ($post) {
    return view('blog.show', compact('post'));
})->name('blog.show');

// Companies Routes
Route::get('/companies', function () {
    return view('companies.index');
})->name('companies.index');

Route::get('/companies/{company}', function ($company) {
    return view('companies.show', compact('company'));
})->name('companies.show');

// Candidates Route
Route::get('/candidates', function () {
    return view('candidates.index');
})->name('candidates');

// Pricing Page
Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

// Locale Routes
Route::get('/locale/{locale}', [LocaleController::class, 'setLocale'])->name('locale');

// Dashboard Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
    
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    
    Route::get('/notifications', function () {
        return view('notifications');
    })->name('notifications');
    
    // Recruiter Routes
    Route::get('/recruiter/dashboard', [App\Http\Controllers\Recruiter\DashboardController::class, 'index'])->name('recruiter.dashboard');
    
    Route::get('/recruiter/jobs', [App\Http\Controllers\Recruiter\JobsController::class, 'index'])->name('recruiter.jobs');
    
    Route::get('/recruiter/create-offer', [App\Http\Controllers\Recruiter\CreateOfferController::class, 'show'])->name('recruiter.create-offer');
    Route::post('/recruiter/create-offer', [App\Http\Controllers\Recruiter\CreateOfferController::class, 'store'])->name('recruiter.create-offer.store');
    
    // Job management routes
    Route::get('/recruiter/jobs/{job}', [App\Http\Controllers\Recruiter\JobsController::class, 'show'])->name('recruiter.jobs.show');
    Route::get('/recruiter/jobs/{job}/edit', [App\Http\Controllers\Recruiter\CreateOfferController::class, 'edit'])->name('recruiter.jobs.edit');
    Route::put('/recruiter/jobs/{job}', [App\Http\Controllers\Recruiter\CreateOfferController::class, 'update'])->name('recruiter.jobs.update');
    Route::delete('/recruiter/jobs/{job}', [App\Http\Controllers\Recruiter\JobsController::class, 'destroy'])->name('recruiter.jobs.destroy');
    
    Route::get('/recruiter/candidates', function () {
        return view('dashboard.recruiter.candidates');
    })->name('recruiter.candidates');
    
    Route::get('/recruiter/interviews', function () {
        return view('dashboard.recruiter.interviews');
    })->name('recruiter.interviews');
    
    Route::get('/recruiter/reports', function () {
        return view('dashboard.recruiter.reports');
    })->name('recruiter.reports');
    
    // Recruiter Company Profile
    Route::get('/recruiter/company-profile', [App\Http\Controllers\Recruiter\CompanyProfileController::class, 'show'])->name('recruiter.company-profile');
    Route::put('/recruiter/company-profile', [App\Http\Controllers\Recruiter\CompanyProfileController::class, 'update'])->name('recruiter.company-profile.update');
    
    
    Route::get('/candidate/applications', function () {
        return view('dashboard.candidate.applications');
    })->name('candidate.applications');
    
    Route::get('/candidate/referrals', function () {
        return view('dashboard.candidate.referrals');
    })->name('candidate.referrals');
});

// Catch-all route for 404 errors - must be at the end
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
