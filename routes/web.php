<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SuratKontrakControllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidationController;
use App\Models\Pengajuan;
use App\Models\SuratKontrak;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
//USERS RESOURCE
Route::resource('/users', UserController::class);

//PENGAJUAN RESOURCE
Route::resource('/pengajuan', PengajuanController::class);

//KELOLA SURAT DAN PENGARSIPAN RESOURCE
Route::get('/cetak-surat', [SuratKontrakControllers::class, 'cetak'])->name('surat.cetak');
Route::resource('/kelola-surat', SuratKontrakControllers::class);

Route::get('/pengarsipan-surat-kontrak', [SuratKontrakControllers::class, 'pengarsipan'])->name('pengarsipan');


//VALIDASI RESOURCE
Route::patch('/ubah-status-validasi-pengajuan', [ValidationController::class, 'changeStatus'])->name('validasi.ubah.status');
Route::resource('/validasi-pengajuan', ValidationController::class);





// Route::get('/pengajuan-dana-hibah/store', [PengajuanController::class, 'index'])->name('pengajuan.store');
// Route::get('/pengajuan-dana-Insentif', [PengajuanController::class, 'index2'])->name('viewPengajuanInsentif');
// Route::get('/validasi-dana-hibah', [validationController::class, 'index'])->name('validasi.dana.hibah');
// Route::get('/validasi-dana-insentif', [validationController::class, 'index2'])->name('validasi.dana.insentif');
