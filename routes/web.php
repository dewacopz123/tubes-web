<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KaryawanController;

Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::get('/auth/google', [LoginController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [LoginController::class, 'callback']);

Route::get('/karyawan', [KaryawanController::class, 'index']);

// modal form (1 file)
Route::get('/karyawan/form', fn () => view('karyawan.form'));

// CRUD JSON
Route::post('/karyawan', [KaryawanController::class, 'store']);
Route::get('/karyawan/{id}', [KaryawanController::class, 'show']);
Route::put('/karyawan/{id}', [KaryawanController::class, 'update']);
Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy']);


