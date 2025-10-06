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
    Route::get('/admin/users', function () {
        return view('dashboard.admin.users');
    })->name('admin.users');
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

Route::get('/admin/blog/editor', function () {
    return view('dashboard.admin.blog-editor');
})->name('admin.blog.editor');
    Route::get('/recruiter/dashboard', function () {
        return view('dashboard.recruiter.index');
    })->name('recruiter.dashboard');
    Route::get('/candidate/dashboard', [App\Http\Controllers\Candidate\DashboardController::class, 'index'])->name('candidate.dashboard');
});

// Password Reset Routes
Route::get('/password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');

// Jobs Routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');

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
    Route::get('/recruiter/dashboard', function () {
        return view('dashboard.recruiter.index');
    })->name('recruiter.dashboard');
    
    Route::get('/recruiter/jobs', function () {
        return view('dashboard.recruiter.jobs');
    })->name('recruiter.jobs');
    
    Route::get('/recruiter/create-offer', function () {
        return view('dashboard.recruiter.create-offer');
    })->name('recruiter.create-offer');
    
    Route::get('/recruiter/candidates', function () {
        return view('dashboard.recruiter.candidates');
    })->name('recruiter.candidates');
    
    Route::get('/recruiter/interviews', function () {
        return view('dashboard.recruiter.interviews');
    })->name('recruiter.interviews');
    
    Route::get('/recruiter/reports', function () {
        return view('dashboard.recruiter.reports');
    })->name('recruiter.reports');
    
    Route::get('/candidate/dashboard', function () {
        return view('dashboard.candidate.index');
    })->name('candidate.dashboard');
    
    Route::get('/candidate/profile', function () {
        return view('dashboard.candidate.profile');
    })->name('candidate.profile');
    
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
