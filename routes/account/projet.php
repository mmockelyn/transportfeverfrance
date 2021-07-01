<?php

use App\Http\Controllers\Account\BadgeController;
use App\Http\Controllers\Account\ProfilController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "project"], function () {
    Route::get('/', [\App\Http\Controllers\Account\ProjectController::class, 'index'])->name('account.project');
    Route::post('/register', [\App\Http\Controllers\Account\ProjectController::class, 'register'])->name('account.project.register');
});
