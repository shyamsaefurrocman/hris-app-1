<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\UserAbsenController;

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
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/registrasi', [LoginController::class, 'create'])->name('registrasi');

Route::post('/processregistrasi', [LoginController::class, 'store'])->name('processregistrasi');

Route::post('/processlogin', [LoginController::class, 'proccesslogin'])->name('processlogin');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/home', UserAbsenController::class);
    Route::resource('/dashboard', AdminController::class);
    Route::resource('/pegawai', PegawaiController::class);
    Route::post('/pegawai/delete', [PegawaiController::class, 'delete'])->name('pegawai.delete');
    Route::resource('/absensi', AbsensiController::class);
    Route::post('/absensi/delete', [AbsensiController::class, 'delete'])->name('absensi.delete');
    Route::put('/userpresensi', [UserAbsenController::class, 'updatePresensi'])->name('presensi.update');
});
