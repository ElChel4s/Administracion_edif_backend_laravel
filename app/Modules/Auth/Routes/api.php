<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Auth\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Auth Module Routes
|--------------------------------------------------------------------------
|
| Rutas para autenticación y gestión de usuarios
|
*/

Route::prefix('auth')->group(function () {
    // Rutas públicas (sin autenticación)
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    
    // Rutas protegidas (requieren JWT)
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
});