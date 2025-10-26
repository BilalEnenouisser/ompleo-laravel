<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public API Routes (No Authentication Required)
Route::prefix('v1')->group(function () {
    // Jobs API
    Route::get('/jobs', [App\Http\Controllers\Api\JobController::class, 'index']);
    Route::get('/jobs/{job:slug}', [App\Http\Controllers\Api\JobController::class, 'show']);
    
    // Companies API
    Route::get('/companies', [App\Http\Controllers\Api\CompanyController::class, 'index']);
    Route::get('/companies/{company:slug}', [App\Http\Controllers\Api\CompanyController::class, 'show']);
    
    // Blog API
    Route::get('/blog', [App\Http\Controllers\Api\BlogController::class, 'index']);
    Route::get('/blog/{blog:slug}', [App\Http\Controllers\Api\BlogController::class, 'show']);
});

// Protected API Routes (Session Authentication Required)
Route::middleware('auth:web')->prefix('v1')->group(function () {
    // User Profile API
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::get('/profile', [App\Http\Controllers\Api\ProfileController::class, 'show']);
    Route::put('/profile', [App\Http\Controllers\Api\ProfileController::class, 'update']);
    
    // Jobs Management API (Recruiter/Admin)
    Route::middleware('check.user.type:recruiter,admin')->group(function () {
        Route::post('/jobs', [App\Http\Controllers\Api\JobController::class, 'store']);
        Route::put('/jobs/{job}', [App\Http\Controllers\Api\JobController::class, 'update']);
        Route::delete('/jobs/{job}', [App\Http\Controllers\Api\JobController::class, 'destroy']);
        Route::patch('/jobs/{job}/status', [App\Http\Controllers\Api\JobController::class, 'updateStatus']);
    });
    
    // Applications API
    Route::get('/applications', [App\Http\Controllers\Api\ApplicationController::class, 'index']);
    Route::post('/applications', [App\Http\Controllers\Api\ApplicationController::class, 'store']);
    Route::get('/applications/{application}', [App\Http\Controllers\Api\ApplicationController::class, 'show']);
    Route::put('/applications/{application}/status', [App\Http\Controllers\Api\ApplicationController::class, 'updateStatus']);
    Route::delete('/applications/{application}', [App\Http\Controllers\Api\ApplicationController::class, 'destroy']);
    
    // Notifications API
    Route::get('/notifications', [App\Http\Controllers\Api\NotificationController::class, 'index']);
    Route::get('/notifications/unread-count', [App\Http\Controllers\Api\NotificationController::class, 'unreadCount']);
    Route::post('/notifications/{id}/read', [App\Http\Controllers\Api\NotificationController::class, 'markAsRead']);
    Route::post('/notifications/read-all', [App\Http\Controllers\Api\NotificationController::class, 'markAllAsRead']);
    Route::delete('/notifications/{id}', [App\Http\Controllers\Api\NotificationController::class, 'destroy']);
    
    // Admin API Routes (commented out until controllers are created)
    // Route::middleware('check.user.type:admin')->prefix('admin')->group(function () {
    //     // Users Management
    //     Route::get('/users', [App\Http\Controllers\Api\Admin\UserController::class, 'index']);
    //     Route::post('/users', [App\Http\Controllers\Api\Admin\UserController::class, 'store']);
    //     Route::get('/users/{user}', [App\Http\Controllers\Api\Admin\UserController::class, 'show']);
    //     Route::put('/users/{user}', [App\Http\Controllers\Api\Admin\UserController::class, 'update']);
    //     Route::delete('/users/{user}', [App\Http\Controllers\Api\Admin\UserController::class, 'destroy']);
        
    //     // Companies Management
    //     Route::get('/companies', [App\Http\Controllers\Api\Admin\CompanyController::class, 'index']);
    //     Route::post('/companies', [App\Http\Controllers\Api\Admin\CompanyController::class, 'store']);
    //     Route::get('/companies/{company}', [App\Http\Controllers\Api\Admin\CompanyController::class, 'show']);
    //     Route::put('/companies/{company}', [App\Http\Controllers\Api\Admin\CompanyController::class, 'update']);
    //     Route::delete('/companies/{company}', [App\Http\Controllers\Api\Admin\CompanyController::class, 'destroy']);
        
    //     // Jobs Management
    //     Route::get('/jobs', [App\Http\Controllers\Api\Admin\JobController::class, 'index']);
    //     Route::get('/jobs/{job}', [App\Http\Controllers\Api\Admin\JobController::class, 'show']);
    //     Route::put('/jobs/{job}', [App\Http\Controllers\Api\Admin\JobController::class, 'update']);
    //     Route::delete('/jobs/{job}', [App\Http\Controllers\Api\Admin\JobController::class, 'destroy']);
        
    //     // Reports Management
    //     Route::get('/reports', [App\Http\Controllers\Api\Admin\ReportController::class, 'index']);
    //     Route::put('/reports/{report}/status', [App\Http\Controllers\Api\Admin\ReportController::class, 'updateStatus']);
        
    //     // Statistics API
    //     Route::get('/stats', [App\Http\Controllers\Api\Admin\StatsController::class, 'index']);
    //     Route::get('/stats/export', [App\Http\Controllers\Api\Admin\StatsController::class, 'export']);
    // });
    
    // Recruiter API Routes (commented out until controllers are created)
    // Route::middleware('check.user.type:recruiter')->prefix('recruiter')->group(function () {
    //     Route::get('/dashboard', [App\Http\Controllers\Api\Recruiter\DashboardController::class, 'index']);
    //     Route::get('/jobs', [App\Http\Controllers\Api\Recruiter\JobController::class, 'index']);
    //     Route::get('/jobs/{job}/applications', [App\Http\Controllers\Api\Recruiter\ApplicationController::class, 'index']);
    //     Route::get('/reports', [App\Http\Controllers\Api\Recruiter\ReportController::class, 'index']);
    // });
    
    // Candidate API Routes (commented out until controllers are created)
    // Route::middleware('check.user.type:candidate')->prefix('candidate')->group(function () {
    //     Route::get('/dashboard', [App\Http\Controllers\Api\Candidate\DashboardController::class, 'index']);
    //     Route::get('/applications', [App\Http\Controllers\Api\Candidate\ApplicationController::class, 'index']);
    //     Route::get('/profile', [App\Http\Controllers\Api\Candidate\ProfileController::class, 'show']);
    //     Route::put('/profile', [App\Http\Controllers\Api\Candidate\ProfileController::class, 'update']);
    // });
});
