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

// Incluir rutas del módulo Auth
Route::prefix('v1')->group(function () {
    include __DIR__ . '/../app/Modules/Auth/Routes/api.php';
});

// Ruta de prueba
Route::get('/test', function () {
    return response()->json([
        'message' => 'API de Administración de Edificios funcionando correctamente',
        'version' => '1.0.0',
        'timestamp' => now()
    ]);
});