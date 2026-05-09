<?php

use App\Http\Controllers\AdminApplicationController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PdfExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\SavedScholarshipController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| USER AUTH
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {

    Route::get('/register', 'showRegister');
    Route::post('/register', 'register');

    Route::get('/login', 'showLogin');
    Route::post('/login', 'login');

    Route::post('/logout', 'logout');

    Route::get('/forgot-password', 'showForgot');
    Route::post('/forgot-password', 'sendReset');

    Route::get('/reset-password/{token}', 'showReset');
    Route::post('/reset-password', 'resetPassword');

    Route::get('/admin/login', 'showAdminLogin');
    Route::post('/admin/login', 'adminLogin');

    Route::get('/verify-otp', 'showOtp');
    Route::post('/verify-otp', 'verifyOtp');

    Route::post('/resend-otp', 'resendOtp');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])
        ->name('notifications.unread');

    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markRead'])
        ->name('notifications.read');

    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])
        ->name('notifications.readAll');

    /*
    |--------------------------------------------------------------------------
    | PROFILE (STUDENT)
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    /*
    |--------------------------------------------------------------------------
    | STUDENT SCHOLARSHIPS
    |--------------------------------------------------------------------------
    */

    Route::get('/scholarships', [ScholarshipController::class, 'studentIndex'])
        ->name('scholarships.index');

    Route::get('/scholarships/{scholarship}', [ScholarshipController::class, 'show'])
        ->name('scholarships.show');

    /*
    |--------------------------------------------------------------------------
    | SAVED SCHOLARSHIPS
    |--------------------------------------------------------------------------
    */

    Route::get('/saved', [SavedScholarshipController::class, 'index'])
        ->name('saved.index');

    Route::post('/scholarships/{scholarship}/save', [SavedScholarshipController::class, 'toggle'])
        ->name('saved.toggle');

    /*
    |--------------------------------------------------------------------------
    | RECOMMENDATIONS
    |--------------------------------------------------------------------------
    */

    Route::get('/recommendations', [RecommendationController::class, 'index'])
        ->name('recommendations.index');

    /*
    |--------------------------------------------------------------------------
    | APPLICATIONS (STUDENT)
    |--------------------------------------------------------------------------
    */

    Route::get('/my-applications', [ApplicationController::class, 'index'])
        ->name('applications.index');

    Route::post('/scholarships/{scholarship}/apply', [ApplicationController::class, 'store'])
        ->name('applications.store');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | SCHOLARSHIP CRUD
        |--------------------------------------------------------------------------
        */

        Route::get('/scholarships', [ScholarshipController::class, 'index'])
            ->name('scholarships.index');

        Route::get('/scholarships/create', [ScholarshipController::class, 'create'])
            ->name('scholarships.create');

        Route::post('/scholarships', [ScholarshipController::class, 'store'])
            ->name('scholarships.store');

        Route::get('/scholarships/{scholarship}/edit', [ScholarshipController::class, 'edit'])
            ->name('scholarships.edit');

        Route::put('/scholarships/{scholarship}', [ScholarshipController::class, 'update'])
            ->name('scholarships.update');

        Route::delete('/scholarships/{scholarship}', [ScholarshipController::class, 'destroy'])
            ->name('scholarships.destroy');

        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        Route::get('/categories', [CategoryController::class, 'index'])
            ->name('categories.index');

        Route::get('/categories/create', [CategoryController::class, 'create'])
            ->name('categories.create');

        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
            ->name('categories.edit');

        Route::put('/categories/{category}', [CategoryController::class, 'update'])
            ->name('categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy');

        /*
        |--------------------------------------------------------------------------
        | APPLICATIONS
        |--------------------------------------------------------------------------
        */

        Route::get('/applications', [AdminApplicationController::class, 'index'])
            ->name('applications.index');

        Route::get('/applications/{application}', [AdminApplicationController::class, 'show'])
            ->name('applications.show');

        Route::post('/applications/{application}/approve', [AdminApplicationController::class, 'approve'])
            ->name('applications.approve');

        Route::post('/applications/{application}/reject', [AdminApplicationController::class, 'reject'])
            ->name('applications.reject');

        /*
        |--------------------------------------------------------------------------
        | ANALYTICS
        |--------------------------------------------------------------------------
        */

        Route::get('/analytics', [AnalyticsController::class, 'index'])
            ->name('analytics.index');

        /*
        |--------------------------------------------------------------------------
        | PDF EXPORTS
        |--------------------------------------------------------------------------
        */

        Route::get('/export/applications', [PdfExportController::class, 'exportApplications'])
            ->name('export.applications');

        Route::get('/export/scholarships/{scholarship}', [PdfExportController::class, 'exportScholarship'])
            ->name('export.scholarship');
    });

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'super_admin'])
    ->prefix('super-admin')
    ->name('super_admin.')
    ->group(function () {

        Route::get('/users', [SuperAdminController::class, 'users'])
            ->name('users.index');

        Route::post('/users/{user}/role', [SuperAdminController::class, 'updateRole'])
            ->name('users.role');

        Route::delete('/users/{user}', [SuperAdminController::class, 'destroy'])
            ->name('users.destroy');
    });

/*
|--------------------------------------------------------------------------
| DOCUMENTS
|--------------------------------------------------------------------------
*/

Route::get('/documents/{document}', [ApplicationController::class, 'download'])
    ->name('documents.download');

Route::get('/documents/{document}/download', [ApplicationController::class, 'download']);

Route::get('/documents/{document}/preview', [ApplicationController::class, 'preview'])
    ->name('documents.preview');
