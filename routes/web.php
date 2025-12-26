<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KaryawanController;

Route::get('/', function () {
    return redirect()->route('login.index');
});

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::middleware('auth')->group(function () {
    Route::resource('karyawan', KaryawanController::class);
});



Route::get('/auth/google', [LoginController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [LoginController::class, 'callback']);
