<?php

use App\Http\Controllers\api\ApiAllController;
use App\Http\Controllers\api\ApiAuthController;
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
Route::post('/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/me', [ApiAuthController::class, 'me']);
    Route::get('/nilai', [ApiAllController::class, 'nilai']);
    Route::get('/jadwal', [ApiAllController::class, 'jadwal']);
    Route::get('/siswa', [ApiAllController::class, 'siswa']);
    Route::post('/nilai', [ApiAllController::class, 'tambahNilai']);
    Route::put('/nilai/{id_nilai}', [ApiAllController::class, 'editNilai']);
    Route::delete('/nilai/{id_nilai}', [ApiAllController::class, 'deleteNilai']);
    Route::get('/nilaibysemester', [ApiAllController::class, 'nilaipersemester']);
});
