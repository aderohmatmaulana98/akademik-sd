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
    //Dashboard
    Route::get('/admin-dashboard','dashboard')->name('admin.dashboard');

    //Tahun Ajaran
    Route::get('/admin/tahun-ajaran','tahunAjaran')->name('admin.tahunajaran');
    Route::post('/admin/tahun-ajaran','tambahThAjaran')->name('admin.tambahtahunajaran');
    Route::post('/admin/tahun-ajaran/{id_tahun_ajaran}','editThAjaran')->name('admin.edittahunajaran');
    Route::delete('/admin/tahun-ajaran/{id_tahun_ajaran}','deleteThAjaran')->name('admin.deletetahunajaran');

    //Semester
    Route::get('/admin/semester','semester')->name('admin.semester');
    Route::post('/admin/semester','tambahSemester')->name('admin.tambahSemester');
    Route::post('/admin/semester/{id_semester}','editSemester')->name('admin.editSemester');
    Route::delete('/admin/semester/{id_semester}','deleteSemester')->name('admin.deleteSemester');
    
    //Kelas
    Route::get('/admin/kelas','kelas')->name('admin.kelas');
    Route::post('/admin/kelas','tambahKelas')->name('admin.tambahKelas');
    Route::post('/admin/kelas/{id_kelas}','editKelas')->name('admin.editKelas');
    Route::delete('/admin/kelas/{id_kelas}','deleteKelas')->name('admin.deleteKelas');

    //mapel
    Route::get('/admin/mapel','mapel')->name('admin.mapel');
    Route::post('/admin/mapel','tambahMapel')->name('admin.tambahMapel');
    Route::post('/admin/mapel/{id_mapel}','editMapel')->name('admin.editMapel');
    Route::delete('/admin/mapel/{id_mapel}','deleteMapel')->name('admin.deleteMapel');

    //siswa
    Route::get('/admin/siswa','siswa')->name('admin.siswa');
    Route::get('/admin/siswa/detail/{id_siswa}','detailSiswa')->name('admin.detailSiswa');
    Route::post('/admin/siswa','tambahSiswa')->name('admin.tambahSiswa');
    Route::post('/admin/siswa/{id_siswa}','editsiswa')->name('admin.editSiswa');
    Route::delete('/admin/siswa/{id_user}','deleteSiswa')->name('admin.deleteSiswa');

    //Wali kelas
    Route::get('/admin/wali_kelas','waliKelas')->name('admin.wali_kelas');
    Route::get('/admin/wali_kelas/detail/{id_wali_kelas}','detailWaliKelas')->name('admin.detailWaliKelas');
    Route::post('/admin/wali_kelas','tambahWaliKelas')->name('admin.tambahWaliKelas');
    Route::post('/admin/wali_kelas/{id_wali_kelas}','editWaliKelas')->name('admin.editWaliKelas');
    Route::delete('/admin/wali_kelas/{id_user}','deleteWaliKelas')->name('admin.deleteWaliKelas');

    Route::get('/admin/penilaian','penilaian')->name('admin.penilaian');

    //Profile
    Route::get('/admin/profile','profile')->name('admin.profile');
});
