<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/candidate/dashboard', [App\Http\Controllers\Candidate\DashboardController::class, 'index'])->name('candidate.dashboard');
    Route::get('/candidate/profile/{user?}', [App\Http\Controllers\Candidate\ProfileController::class, 'show'])->name('candidate.profile');
    Route::put('/candidate/profile', [App\Http\Controllers\Candidate\ProfileController::class, 'update'])->name('candidate.profile.update');

    Route::get('/candidate/{user}/profile', [App\Http\Controllers\Candidate\ProfileController::class, 'publicShow'])->name('candidate.profile.public');

    Route::get('/applications', [App\Http\Controllers\ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/export-pdf', [App\Http\Controllers\ApplicationController::class, 'exportPdf'])->name('applications.export-pdf');
    Route::get('/jobs/{job}/apply', [App\Http\Controllers\ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications', [App\Http\Controllers\ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{application}', [App\Http\Controllers\ApplicationController::class, 'show'])->name('applications.show');
    Route::delete('/applications/{application}', [App\Http\Controllers\ApplicationController::class, 'withdraw'])->name('applications.withdraw');

    Route::get('/dashboard', function () {
        $user = auth()->user();

        switch ($user->user_type) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'recruiter':
                return redirect()->route('recruiter.dashboard');
            case 'candidate':
                return redirect()->route('candidate.dashboard');
            default:
                return redirect()->route('home');
        }
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::prefix('notifications')->group(function () {
        Route::get('/', function () {
            $user = auth()->user();

            if ($user->isAdmin()) {
                return redirect()->route('admin.notifications.view');
            }

            if ($user->isRecruiter()) {
                return redirect()->route('recruiter.notifications');
            }

            if ($user->isCandidate()) {
                return redirect()->route('candidate.notifications');
            }

            return redirect()->route('home');
        })->name('notifications');

        Route::post('/{id}/read', [App\Http\Controllers\UserNotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
        Route::post('/read-all', [App\Http\Controllers\UserNotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
        Route::delete('/{id}', [App\Http\Controllers\UserNotificationController::class, 'destroy'])->name('notifications.destroy');
        Route::delete('/', [App\Http\Controllers\UserNotificationController::class, 'destroyAll'])->name('notifications.destroyAll');
    });

    Route::get('/api/notifications', [App\Http\Controllers\UserNotificationController::class, 'getNotifications'])->name('notifications.api');

    Route::middleware('recruiter')->group(function () {
        Route::get('/recruiter/dashboard', [App\Http\Controllers\Recruiter\DashboardController::class, 'index'])->name('recruiter.dashboard');
        Route::get('/recruiter/jobs', [App\Http\Controllers\Recruiter\JobsController::class, 'index'])->name('recruiter.jobs');

        Route::get('/recruiter/notifications', [App\Http\Controllers\Recruiter\NotificationController::class, 'index'])->name('recruiter.notifications');
        Route::post('/recruiter/notifications/{id}/read', [App\Http\Controllers\Recruiter\NotificationController::class, 'markAsRead'])->name('recruiter.notifications.markAsRead');
        Route::post('/recruiter/notifications/read-all', [App\Http\Controllers\Recruiter\NotificationController::class, 'markAllAsRead'])->name('recruiter.notifications.markAllAsRead');
        Route::delete('/recruiter/notifications/{id}', [App\Http\Controllers\Recruiter\NotificationController::class, 'destroy'])->name('recruiter.notifications.destroy');
        Route::delete('/recruiter/notifications', [App\Http\Controllers\Recruiter\NotificationController::class, 'destroyAll'])->name('recruiter.notifications.destroyAll');

        Route::get('/recruiter/create-offer', [App\Http\Controllers\Recruiter\CreateOfferController::class, 'show'])->name('recruiter.create-offer');
        Route::post('/recruiter/create-offer', [App\Http\Controllers\Recruiter\CreateOfferController::class, 'store'])->name('recruiter.create-offer.store');

        Route::get('/recruiter/jobs/{job}', [App\Http\Controllers\Recruiter\JobsController::class, 'show'])->name('recruiter.jobs.show');
        Route::get('/recruiter/jobs/{job}/edit', [App\Http\Controllers\Recruiter\CreateOfferController::class, 'edit'])->name('recruiter.jobs.edit');
        Route::put('/recruiter/jobs/{job}', [App\Http\Controllers\Recruiter\CreateOfferController::class, 'update'])->name('recruiter.jobs.update');
        Route::delete('/recruiter/jobs/{job}', [App\Http\Controllers\Recruiter\JobsController::class, 'destroy'])->name('recruiter.jobs.destroy');

        Route::get('/recruiter/jobs/{job}/applications', [App\Http\Controllers\Recruiter\JobsController::class, 'applications'])->name('recruiter.jobs.applications');
        Route::put('/applications/{application}/status', [App\Http\Controllers\ApplicationController::class, 'updateStatus'])->name('applications.update-status');

        Route::get('/recruiter/candidates', [App\Http\Controllers\Recruiter\CandidatesController::class, 'index'])->name('recruiter.candidates');
        Route::get('/recruiter/candidates/{candidate}/profile', [App\Http\Controllers\Candidate\ProfileController::class, 'publicShow'])->name('recruiter.candidate.profile');

        Route::get('/recruiter/interviews', [App\Http\Controllers\Recruiter\InterviewsController::class, 'index'])->name('recruiter.interviews');
        Route::get('/recruiter/interviews/create', [App\Http\Controllers\Recruiter\InterviewsController::class, 'create'])->name('recruiter.interviews.create');
        Route::post('/recruiter/interviews', [App\Http\Controllers\Recruiter\InterviewsController::class, 'store'])->name('recruiter.interviews.store');
        Route::get('/recruiter/interviews/{interview}', [App\Http\Controllers\Recruiter\InterviewsController::class, 'show'])->name('recruiter.interviews.show');
        Route::get('/recruiter/interviews/{interview}/edit', [App\Http\Controllers\Recruiter\InterviewsController::class, 'edit'])->name('recruiter.interviews.edit');
        Route::put('/recruiter/interviews/{interview}', [App\Http\Controllers\Recruiter\InterviewsController::class, 'update'])->name('recruiter.interviews.update');
        Route::put('/recruiter/interviews/{interview}/status', [App\Http\Controllers\Recruiter\InterviewsController::class, 'updateStatus'])->name('recruiter.interviews.update-status');
        Route::delete('/recruiter/interviews/{interview}', [App\Http\Controllers\Recruiter\InterviewsController::class, 'destroy'])->name('recruiter.interviews.destroy');
        Route::get('/recruiter/interviews/calendar/data', [App\Http\Controllers\Recruiter\InterviewsController::class, 'calendar'])->name('recruiter.interviews.calendar');

        Route::get('/recruiter/reports', [App\Http\Controllers\Recruiter\ReportsController::class, 'index'])->name('recruiter.reports');

        Route::get('/recruiter/company-profile', [App\Http\Controllers\Recruiter\CompanyProfileController::class, 'show'])->name('recruiter.company-profile');
        Route::put('/recruiter/company-profile', [App\Http\Controllers\Recruiter\CompanyProfileController::class, 'update'])->name('recruiter.company-profile.update');

        Route::get('/recruiter/subscription', [App\Http\Controllers\Recruiter\SubscriptionController::class, 'index'])->name('recruiter.subscription');

        Route::get('/recruiter/settings', [App\Http\Controllers\Recruiter\SettingsController::class, 'index'])->name('recruiter.settings');
        Route::put('/recruiter/settings', [App\Http\Controllers\Recruiter\SettingsController::class, 'update'])->name('recruiter.settings.update');
    });

    Route::get('/candidate/applications', [App\Http\Controllers\ApplicationController::class, 'index'])->name('candidate.applications');

    Route::get('/candidate/settings', [App\Http\Controllers\Candidate\SettingsController::class, 'index'])->name('candidate.settings');
    Route::put('/candidate/settings', [App\Http\Controllers\Candidate\SettingsController::class, 'update'])->name('candidate.settings.update');

    Route::get('/candidate/referrals', function () {
        return view('dashboard.candidate.referrals');
    })->name('candidate.referrals');

    Route::get('/candidate/notifications', [App\Http\Controllers\Candidate\NotificationController::class, 'index'])->name('candidate.notifications');
    Route::post('/candidate/notifications/{id}/read', [App\Http\Controllers\Candidate\NotificationController::class, 'markAsRead'])->name('candidate.notifications.markAsRead');

    Route::get('/candidate/interviews/{interview}', [App\Http\Controllers\Candidate\InterviewController::class, 'show'])->name('candidate.interviews.show');
    Route::post('/candidate/interviews/{interview}/confirm', [App\Http\Controllers\Candidate\InterviewController::class, 'confirm'])->name('candidate.interviews.confirm');
    Route::post('/candidate/interviews/{interview}/cancel', [App\Http\Controllers\Candidate\InterviewController::class, 'cancel'])->name('candidate.interviews.cancel');
    Route::post('/candidate/interviews/{interview}/request-change', [App\Http\Controllers\Candidate\InterviewController::class, 'requestChange'])->name('candidate.interviews.request-change');
    Route::post('/candidate/interviews/{interview}/report-problem', [App\Http\Controllers\Candidate\InterviewController::class, 'reportProblem'])->name('candidate.interviews.report-problem');
    Route::post('/candidate/notifications/read-all', [App\Http\Controllers\Candidate\NotificationController::class, 'markAllAsRead'])->name('candidate.notifications.markAllAsRead');
    Route::delete('/candidate/notifications/{id}', [App\Http\Controllers\Candidate\NotificationController::class, 'destroy'])->name('candidate.notifications.destroy');
    Route::delete('/candidate/notifications', [App\Http\Controllers\Candidate\NotificationController::class, 'destroyAll'])->name('candidate.notifications.destroyAll');
});
