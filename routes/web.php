<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| USER AUTH
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

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