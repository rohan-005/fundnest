<?php

use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ScholarshipController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC API ROUTES
|--------------------------------------------------------------------------
*/

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| AUTHENTICATED API ROUTES (Sanctum)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Scholarships
    Route::get('/scholarships', [ScholarshipController::class, 'index']);
    Route::get('/scholarships/{scholarship}', [ScholarshipController::class, 'show']);

    // Applications
    Route::get('/applications', [ApplicationController::class, 'index']);
    Route::post('/scholarships/{scholarship}/apply', [ApplicationController::class, 'store']);
});
