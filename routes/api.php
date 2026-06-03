<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SyncController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['api.token'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/karyawans', [SyncController::class, 'karyawans']);
    Route::get('/jobdesks', [SyncController::class, 'jobdesks']);
    Route::get('/absensis', [SyncController::class, 'absensis']);
    Route::get('/penggajians', [SyncController::class, 'penggajians']);

    Route::post('/absensi/masuk', [SyncController::class, 'absensiMasuk']);
    Route::post('/absensi/keluar', [SyncController::class, 'absensiKeluar']);

    Route::post('/jobdesk', [SyncController::class, 'storeJobdesk']);
    Route::put('/jobdesk/{id}', [SyncController::class, 'updateJobdesk']);
    Route::delete('/jobdesk/{id}', [SyncController::class, 'destroyJobdesk']);

    Route::post('/penggajian', [SyncController::class, 'storePenggajian']);
    Route::put('/penggajian/{id}', [SyncController::class, 'updatePenggajian']);
    Route::delete('/penggajian/{id}', [SyncController::class, 'destroyPenggajian']);
});
