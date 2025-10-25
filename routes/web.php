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

    Route::get('/admin/jobs', function () {
        return view('dashboard.admin.jobs');
    })->name('admin.jobs');
    Route::get('/admin/partners', [App\Http\Controllers\Admin\PartnersController::class, 'index'])->name('admin.partners');
    Route::post('/admin/partners', [App\Http\Controllers\Admin\PartnersController::class, 'store'])->name('admin.partners.store');
    Route::get('/admin/partners/{partner}', [App\Http\Controllers\Admin\PartnersController::class, 'show'])->name('admin.partners.show');
    Route::put('/admin/partners/{partner}', [App\Http\Controllers\Admin\PartnersController::class, 'update'])->name('admin.partners.update');
    Route::delete('/admin/partners/{partner}', [App\Http\Controllers\Admin\PartnersController::class, 'destroy'])->name('admin.partners.destroy');
    Route::patch('/admin/partners/{partner}/toggle-featured', [App\Http\Controllers\Admin\PartnersController::class, 'toggleFeatured'])->name('admin.partners.toggle-featured');
    Route::get('/admin/blog', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('admin.blog');
    Route::get('/admin/blog/editor', [App\Http\Controllers\Admin\BlogController::class, 'editor'])->name('admin.blog.editor');
    Route::get('/admin/blog/editor/{id}', [App\Http\Controllers\Admin\BlogController::class, 'editor'])->name('admin.blog.editor.edit');
    Route::post('/admin/blog', [App\Http\Controllers\Admin\BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/admin/blog/{blog}', [App\Http\Controllers\Admin\BlogController::class, 'show'])->name('admin.blog.show');
    Route::put('/admin/blog/{blog}', [App\Http\Controllers\Admin\BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('/admin/blog/{blog}', [App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('admin.blog.destroy');
    Route::patch('/admin/blog/{blog}/toggle-status', [App\Http\Controllers\Admin\BlogController::class, 'toggleStatus'])->name('admin.blog.toggle-status');
    Route::post('/admin/blog/upload-image', [App\Http\Controllers\Admin\BlogController::class, 'uploadImage'])->name('admin.blog.upload-image');
// Admin notification management (create/send notifications)
Route::get('/admin/notifications', [App\Http\Controllers\Admin\NotificationsController::class, 'index'])->name('admin.notifications');
Route::post('/admin/notifications', [App\Http\Controllers\Admin\NotificationsController::class, 'store'])->name('admin.notifications.store');
Route::post('/admin/notifications/{notification}/send', [App\Http\Controllers\Admin\NotificationsController::class, 'send'])->name('admin.notifications.send');
Route::delete('/admin/notifications/{notification}', [App\Http\Controllers\Admin\NotificationsController::class, 'destroy'])->name('admin.notifications.destroy');
Route::get('/admin/notifications/stats', [App\Http\Controllers\Admin\NotificationsController::class, 'stats'])->name('admin.notifications.stats');

// Admin notification viewing (view all user notifications)
Route::get('/admin/notifications/view', [App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('admin.notifications.view');
Route::post('/admin/notifications/view/{id}/read', [App\Http\Controllers\Admin\NotificationController::class, 'markAsRead'])->name('admin.notifications.markAsRead');
Route::post('/admin/notifications/view/read-all', [App\Http\Controllers\Admin\NotificationController::class, 'markAllAsRead'])->name('admin.notifications.markAllAsRead');
Route::delete('/admin/notifications/view/{id}', [App\Http\Controllers\Admin\NotificationController::class, 'destroy'])->name('admin.notifications.destroy');
Route::delete('/admin/notifications/view', [App\Http\Controllers\Admin\NotificationController::class, 'destroyAll'])->name('admin.notifications.destroyAll');


// Export routes
Route::get('/admin/export/stats', [App\Http\Controllers\Admin\ExportController::class, 'stats'])->name('admin.export.stats');

// Reports routes
Route::get('/admin/reports', [App\Http\Controllers\Admin\ReportsController::class, 'index'])->name('admin.reports');
Route::post('/admin/reports/{report}/action', [App\Http\Controllers\Admin\ReportsController::class, 'updateStatus'])->name('admin.reports.action');
Route::get('/admin/reports/search-suggestions', [App\Http\Controllers\Admin\ReportsController::class, 'searchSuggestions'])->name('admin.reports.suggestions');
Route::get('/admin/reports/export', [App\Http\Controllers\Admin\ReportsController::class, 'export'])->name('admin.reports.export');

Route::get('/admin/payments', function () {
    return view('dashboard.admin.payments');
})->name('admin.payments');


Route::get('/admin/blog/editor', function () {
    return view('dashboard.admin.blog-editor');
})->name('admin.blog.editor');
    Route::get('/candidate/dashboard', [App\Http\Controllers\Candidate\DashboardController::class, 'index'])->name('candidate.dashboard');
    Route::get('/candidate/profile/{user?}', [App\Http\Controllers\Candidate\ProfileController::class, 'show'])->name('candidate.profile');
    Route::put('/candidate/profile', [App\Http\Controllers\Candidate\ProfileController::class, 'update'])->name('candidate.profile.update');
    
    // Public candidate profile view (for recruiters)
    Route::get('/candidate/{user}/profile', [App\Http\Controllers\Candidate\ProfileController::class, 'publicShow'])->name('candidate.profile.public');
    
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
Route::get('/jobs/{job:slug}', [JobController::class, 'show'])->name('jobs.show');
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
    
    // Notifications Routes
    Route::get('/notifications', [App\Http\Controllers\UserNotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\UserNotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/read-all', [App\Http\Controllers\UserNotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::delete('/notifications/{id}', [App\Http\Controllers\UserNotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications', [App\Http\Controllers\UserNotificationController::class, 'destroyAll'])->name('notifications.destroyAll');
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
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');

// Companies Routes
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/search', [CompanyController::class, 'search'])->name('companies.search');
Route::get('/companies/{company:slug}', [CompanyController::class, 'show'])->name('companies.show');

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
    
    // General notifications route (redirects based on user type)
    Route::get('/notifications', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.notifications.view');
        } elseif ($user->isRecruiter()) {
            return redirect()->route('recruiter.notifications');
        } elseif ($user->isCandidate()) {
            return redirect()->route('candidate.notifications');
        }
        return redirect()->route('notifications.index');
    })->name('notifications');
    
    // API notifications
    Route::get('/api/notifications', [App\Http\Controllers\UserNotificationController::class, 'getNotifications'])->name('notifications.api');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\UserNotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [App\Http\Controllers\UserNotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::delete('/notifications/{id}', [App\Http\Controllers\UserNotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications', [App\Http\Controllers\UserNotificationController::class, 'destroyAll'])->name('notifications.destroy-all');
    
    // Recruiter Routes
    Route::get('/recruiter/dashboard', [App\Http\Controllers\Recruiter\DashboardController::class, 'index'])->name('recruiter.dashboard');
    
    Route::get('/recruiter/jobs', [App\Http\Controllers\Recruiter\JobsController::class, 'index'])->name('recruiter.jobs');
    
    // Recruiter Notifications
    Route::get('/recruiter/notifications', [App\Http\Controllers\Recruiter\NotificationController::class, 'index'])->name('recruiter.notifications');
    Route::post('/recruiter/notifications/{id}/read', [App\Http\Controllers\Recruiter\NotificationController::class, 'markAsRead'])->name('recruiter.notifications.markAsRead');
    Route::post('/recruiter/notifications/read-all', [App\Http\Controllers\Recruiter\NotificationController::class, 'markAllAsRead'])->name('recruiter.notifications.markAllAsRead');
    Route::delete('/recruiter/notifications/{id}', [App\Http\Controllers\Recruiter\NotificationController::class, 'destroy'])->name('recruiter.notifications.destroy');
    Route::delete('/recruiter/notifications', [App\Http\Controllers\Recruiter\NotificationController::class, 'destroyAll'])->name('recruiter.notifications.destroyAll');
    
    Route::get('/recruiter/create-offer', [App\Http\Controllers\Recruiter\CreateOfferController::class, 'show'])->name('recruiter.create-offer');
    Route::post('/recruiter/create-offer', [App\Http\Controllers\Recruiter\CreateOfferController::class, 'store'])->name('recruiter.create-offer.store');
    
    // Job management routes
    Route::get('/recruiter/jobs/{job}', [App\Http\Controllers\Recruiter\JobsController::class, 'show'])->name('recruiter.jobs.show');
    Route::get('/recruiter/jobs/{job}/edit', [App\Http\Controllers\Recruiter\CreateOfferController::class, 'edit'])->name('recruiter.jobs.edit');
    Route::put('/recruiter/jobs/{job}', [App\Http\Controllers\Recruiter\CreateOfferController::class, 'update'])->name('recruiter.jobs.update');
    Route::delete('/recruiter/jobs/{job}', [App\Http\Controllers\Recruiter\JobsController::class, 'destroy'])->name('recruiter.jobs.destroy');
    
    // Job applications route
    Route::get('/recruiter/jobs/{job}/applications', [App\Http\Controllers\Recruiter\JobsController::class, 'applications'])->name('recruiter.jobs.applications');
    
    // Application status update route
    Route::put('/applications/{application}/status', [App\Http\Controllers\ApplicationController::class, 'updateStatus'])->name('applications.update-status');
    
    Route::get('/recruiter/candidates', function () {
        return view('dashboard.recruiter.candidates');
    })->name('recruiter.candidates');
    
    Route::get('/recruiter/interviews', function () {
        return view('dashboard.recruiter.interviews');
    })->name('recruiter.interviews');
    
    Route::get('/recruiter/reports', [App\Http\Controllers\Recruiter\ReportsController::class, 'index'])->name('recruiter.reports');
    
    // Recruiter Company Profile
    Route::get('/recruiter/company-profile', [App\Http\Controllers\Recruiter\CompanyProfileController::class, 'show'])->name('recruiter.company-profile');
    Route::put('/recruiter/company-profile', [App\Http\Controllers\Recruiter\CompanyProfileController::class, 'update'])->name('recruiter.company-profile.update');
    
    
    Route::get('/candidate/applications', [App\Http\Controllers\ApplicationController::class, 'index'])->name('candidate.applications');
    
    Route::get('/candidate/referrals', function () {
        return view('dashboard.candidate.referrals');
    })->name('candidate.referrals');
    
    // Candidate Notifications
    Route::get('/candidate/notifications', [App\Http\Controllers\Candidate\NotificationController::class, 'index'])->name('candidate.notifications');
    Route::post('/candidate/notifications/{id}/read', [App\Http\Controllers\Candidate\NotificationController::class, 'markAsRead'])->name('candidate.notifications.markAsRead');
    Route::post('/candidate/notifications/read-all', [App\Http\Controllers\Candidate\NotificationController::class, 'markAllAsRead'])->name('candidate.notifications.markAllAsRead');
    Route::delete('/candidate/notifications/{id}', [App\Http\Controllers\Candidate\NotificationController::class, 'destroy'])->name('candidate.notifications.destroy');
    Route::delete('/candidate/notifications', [App\Http\Controllers\Candidate\NotificationController::class, 'destroyAll'])->name('candidate.notifications.destroyAll');
});


// Catch-all route for 404 errors - must be at the end
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
