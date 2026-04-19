<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CompanyController;
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

// Nos Solutions (Recruiter Solutions Page)
Route::get('/nos-solutions', function () {
    return view('nos-solutions');
})->name('nos-solutions');

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
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');

Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// Jobs Routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/api/jobs/search', [JobController::class, 'searchApi'])->name('jobs.api.search');
Route::get('/jobs/{job:slug}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');


// Companies routes
Route::prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/search', [CompanyController::class, 'search'])->name('companies.search');
    Route::get('/candidates/{id}', [CompanyController::class, 'show'])->name('companies.candidates.show');
    Route::get('/{company:slug}', [CompanyController::class, 'showCompany'])->name('companies.show');
    Route::post('/{id}/message', [CompanyController::class, 'sendMessage'])->middleware('auth')->name('companies.sendMessage');

    Route::middleware('auth')->group(function () {
        Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
        Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
        Route::get('/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
        Route::put('/{company}', [CompanyController::class, 'update'])->name('companies.update');
        Route::delete('/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');
    });
});

// Backward-compatible company detail alias
Route::get('/company/{slug}', [CompanyController::class, 'showCompany'])->name('company.detail');

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
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');

// Candidates Route
Route::get('/candidates', function () {
    $totalPublishedJobs = \App\Models\Job::where('status', 'published')->count();
    return view('candidates.index', compact('totalPublishedJobs'));
})->name('candidates');

// Pricing Page
Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

// Locale Routes
Route::get('/locale/{locale}', [LocaleController::class, 'setLocale'])->name('locale');

// Catch-all route for 404 errors - must be at the end
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
