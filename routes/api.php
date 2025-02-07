<?php

use Ijodkor\OneId\Rest\Controllers\OneIdAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('/api/one-id/')->group(function () {
    Route::post('/url', [OneIdAuthController::class, 'login'])->name('one-id.url');
    Route::get('/url', [OneIdAuthController::class, 'login']);
    Route::post('/token', [OneIdAuthController::class, 'token'])->name('one-id.token');
    Route::get('/access', [OneIdAuthController::class, 'access'])->name('one-id.access-code');
});
