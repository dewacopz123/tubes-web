<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return redirect()->route('login.index');
});

Route::get('/login', [LoginController::class, 'index'])->name('login.index');

Route::get('/auth/google', [LoginController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [LoginController::class, 'callback']);

