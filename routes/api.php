<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SyncController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['api.token'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/karyawans', [SyncController::class, 'karyawans']);
    Route::get('/karyawans/{id}', [SyncController::class, 'showKaryawan']);
    Route::post('/karyawans', [SyncController::class, 'storeKaryawan']);
    Route::put('/karyawans/{id}', [SyncController::class, 'updateKaryawan']);
    Route::delete('/karyawans/{id}', [SyncController::class, 'destroyKaryawan']);

    Route::get('/jobdesks', [SyncController::class, 'jobdesks']);
    Route::get('/jobdesks/{id}', [SyncController::class, 'showJobdesk']);
    Route::get('/absensis', [SyncController::class, 'absensis']);
    Route::get('/absensis/{id}', [SyncController::class, 'showAbsensi']);
    Route::post('/absensis', [SyncController::class, 'storeAbsensi']);
    Route::put('/absensis/{id}', [SyncController::class, 'updateAbsensi']);
    Route::delete('/absensis/{id}', [SyncController::class, 'destroyAbsensi']);

    Route::get('/penggajians', [SyncController::class, 'penggajians']);
    Route::get('/penggajians/{id}', [SyncController::class, 'showPenggajian']);

    Route::post('/absensi/masuk', [SyncController::class, 'absensiMasuk']);
    Route::post('/absensi/keluar', [SyncController::class, 'absensiKeluar']);

    Route::post('/jobdesks', [SyncController::class, 'storeJobdesk']);
    Route::put('/jobdesks/{id}', [SyncController::class, 'updateJobdesk']);
    Route::delete('/jobdesks/{id}', [SyncController::class, 'destroyJobdesk']);
    Route::post('/jobdesk', [SyncController::class, 'storeJobdesk']);
    Route::put('/jobdesk/{id}', [SyncController::class, 'updateJobdesk']);
    Route::delete('/jobdesk/{id}', [SyncController::class, 'destroyJobdesk']);

    Route::post('/penggajians', [SyncController::class, 'storePenggajian']);
    Route::put('/penggajians/{id}', [SyncController::class, 'updatePenggajian']);
    Route::delete('/penggajians/{id}', [SyncController::class, 'destroyPenggajian']);
    Route::post('/penggajian', [SyncController::class, 'storePenggajian']);
    Route::put('/penggajian/{id}', [SyncController::class, 'updatePenggajian']);
    Route::delete('/penggajian/{id}', [SyncController::class, 'destroyPenggajian']);
});
