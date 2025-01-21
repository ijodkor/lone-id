<?php

use Ijodkor\OneId\Http\Controllers\OneIdWebAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('/one-id')->group(function () {
    Route::get('/login', [OneIdWebAuthController::class, 'login'])->name('one-id.login');
    Route::get('/web/access', [OneIdWebAuthController::class, 'access'])->name('one-id.access');
});
