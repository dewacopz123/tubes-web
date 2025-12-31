<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JobdeskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggajianController;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/absensi', [AbsensiController::class, 'index']);
Route::post('/absensi/masuk', [AbsensiController::class, 'masuk']);
Route::post('/absensi/keluar', [AbsensiController::class, 'keluar']);

Route::get('/jobdesk', [JobdeskController::class, 'index']);
Route::post('/jobdesk', [JobdeskController::class, 'store']);
Route::get('/jobdesk/form', [JobdeskController::class, 'form']);
Route::get('/jobdesk/{id}', [JobdeskController::class, 'show']);      // ambil data edit
Route::put('/jobdesk/{id}', [JobdeskController::class, 'update']);    // update
Route::delete('/jobdesk/{id}', [JobdeskController::class, 'destroy']); // hapus


Route::get('/penggajian', [PenggajianController::class, 'index'])->name('penggajian.index');
Route::get('/penggajian/create', [PenggajianController::class, 'create'])->name('penggajian.create');
Route::get('/penggajian/edit/{id}', [PenggajianController::class, 'edit'])->name('penggajian.edit');
Route::post('/penggajian/store', [PenggajianController::class, 'store'])->name('penggajian.store');
Route::put('/penggajian/update/{id}', [PenggajianController::class, 'update'])->name('penggajian.update');
Route::delete('/penggajian/delete/{id}', [PenggajianController::class, 'destroy'])->name('penggajian.destroy');
Route::get('/karyawan', [KaryawanController::class, 'index']);

// modal form (1 file)
Route::get('/karyawan/form', fn() => view('karyawan.form'));

// CRUD JSON
Route::post('/karyawan', [KaryawanController::class, 'store']);
Route::get('/karyawan/{id}', [KaryawanController::class, 'show']);
Route::put('/karyawan/{id}', [KaryawanController::class, 'update']);
Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy']);

