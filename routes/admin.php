<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.users');
    Route::post('/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}', [App\Http\Controllers\Admin\UsersController::class, 'show'])->name('admin.users.show');
    Route::put('/admin/users/{user}', [App\Http\Controllers\Admin\UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/admin/jobs', [App\Http\Controllers\Admin\JobsController::class, 'index'])->name('admin.jobs');
    Route::get('/admin/jobs/{job}', [App\Http\Controllers\Admin\JobsController::class, 'show'])->name('admin.jobs.show');
    Route::put('/admin/jobs/{job}', [App\Http\Controllers\Admin\JobsController::class, 'update'])->name('admin.jobs.update');
    Route::patch('/admin/jobs/{job}/status', [App\Http\Controllers\Admin\JobsController::class, 'updateStatus'])->name('admin.jobs.updateStatus');
    Route::delete('/admin/jobs/{job}', [App\Http\Controllers\Admin\JobsController::class, 'destroy'])->name('admin.jobs.destroy');

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

    Route::get('/admin/notifications', [App\Http\Controllers\Admin\NotificationsController::class, 'index'])->name('admin.notifications');
    Route::post('/admin/notifications', [App\Http\Controllers\Admin\NotificationsController::class, 'store'])->name('admin.notifications.store');
    Route::post('/admin/notifications/{notification}/send', [App\Http\Controllers\Admin\NotificationsController::class, 'send'])->name('admin.notifications.send');
    Route::delete('/admin/notifications/{notification}', [App\Http\Controllers\Admin\NotificationsController::class, 'destroy'])->name('admin.notifications.destroy');
    Route::get('/admin/notifications/stats', [App\Http\Controllers\Admin\NotificationsController::class, 'stats'])->name('admin.notifications.stats');

    Route::get('/admin/notifications/view', [App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('admin.notifications.view');
    Route::post('/admin/notifications/view/{id}/read', [App\Http\Controllers\Admin\NotificationController::class, 'markAsRead'])->name('admin.notifications.markAsRead');
    Route::post('/admin/notifications/view/read-all', [App\Http\Controllers\Admin\NotificationController::class, 'markAllAsRead'])->name('admin.notifications.markAllAsRead');
    Route::delete('/admin/notifications/view/{id}', [App\Http\Controllers\Admin\NotificationController::class, 'destroy'])->name('admin.notifications.view.destroy');
    Route::delete('/admin/notifications/view', [App\Http\Controllers\Admin\NotificationController::class, 'destroyAll'])->name('admin.notifications.destroyAll');

    Route::get('/admin/export/stats', [App\Http\Controllers\Admin\ExportController::class, 'stats'])->name('admin.export.stats');

    Route::get('/admin/reports', [App\Http\Controllers\Admin\ReportsController::class, 'index'])->name('admin.reports');
    Route::post('/admin/reports/{report}/action', [App\Http\Controllers\Admin\ReportsController::class, 'updateStatus'])->name('admin.reports.action');
    Route::get('/admin/reports/search-suggestions', [App\Http\Controllers\Admin\ReportsController::class, 'searchSuggestions'])->name('admin.reports.suggestions');
    Route::get('/admin/reports/export', [App\Http\Controllers\Admin\ReportsController::class, 'export'])->name('admin.reports.export');

    Route::get('/admin/payments', [App\Http\Controllers\Admin\PaymentsController::class, 'index'])->name('admin.payments');
    Route::get('/admin/profile', [App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('admin.profile');
    Route::put('/admin/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');

    Route::get('/admin/companies', [App\Http\Controllers\Admin\CompaniesController::class, 'index'])->name('admin.companies');
    Route::get('/admin/companies/create', [App\Http\Controllers\Admin\CompaniesController::class, 'create'])->name('admin.companies.create');
    Route::post('/admin/companies', [App\Http\Controllers\Admin\CompaniesController::class, 'store'])->name('admin.companies.store');
    Route::get('/admin/companies/{company}', [App\Http\Controllers\Admin\CompaniesController::class, 'show'])->name('admin.companies.show');
    Route::get('/admin/companies/{company}/edit', [App\Http\Controllers\Admin\CompaniesController::class, 'edit'])->name('admin.companies.edit');
    Route::patch('/admin/companies/{company}', [App\Http\Controllers\Admin\CompaniesController::class, 'update'])->name('admin.companies.update');
    Route::delete('/admin/companies/{company}', [App\Http\Controllers\Admin\CompaniesController::class, 'destroy'])->name('admin.companies.destroy');
});
