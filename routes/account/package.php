<?php

use App\Http\Controllers\Account\BadgeController;
use App\Http\Controllers\Account\PackageController;
use App\Http\Controllers\Account\ProfilController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "package"], function () {
    Route::get('/', [PackageController::class, 'index'])->name('account.packages');

    Route::get('create', [PackageController::class, 'create'])->name('account.packages.create');
    Route::post('create', [PackageController::class, 'store'])->name('account.packages.store');

    Route::get('import', [PackageController::class, 'import'])->name('account.packages.import');
    Route::post('import', [PackageController::class, 'storage'])->name('account.packages.storage');
});
