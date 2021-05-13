<?php

use App\Http\Controllers\Account\BadgeController;
use App\Http\Controllers\Account\PackageController;
use App\Http\Controllers\Account\ProfilController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "package"], function () {
    Route::get('/', [PackageController::class, 'index'])->name('account.packages');
});
