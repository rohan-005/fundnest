<?php

use App\Http\Controllers\AuthController;
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
    Route::post('/verify-otp','verifyOtp');

    Route::post('/resend-otp','resendOtp');

});
/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showAdminLogin']);
Route::post('/admin/login', [AuthController::class, 'adminLogin']);

/*
|--------------------------------------------------------------------------
| DASHBOARDS
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard']);
