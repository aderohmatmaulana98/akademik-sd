<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group( function (){
    Route::get('/','login')->name('login');
    Route::post('login','login_action')->name('login.action');
});
Route::controller(AdminController::class)->group( function (){
    Route::get('/admin-dashboard','dashboard')->name('admin.dashboard');
    Route::get('/admin/tahun_ajaran','tahunAjaran')->name('admin.tahunajaran');
});
