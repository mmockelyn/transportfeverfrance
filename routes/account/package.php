<?php

use App\Http\Controllers\Account\BadgeController;
use App\Http\Controllers\Account\PackageController;
use App\Http\Controllers\Account\ProfilController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "package"], function () {
    Route::get('/', [PackageController::class, 'index'])->name('account.packages');

    Route::get('create', [PackageController::class, 'create'])->name('account.packages.create');
    Route::get('create/steam', [PackageController::class, 'createSteam'])->name('account.packages.createSteam');
    Route::get('create/tf_net', [PackageController::class, 'createTfnet'])->name('account.packages.createTfnet');
    Route::get('create/tf_france', [PackageController::class, 'createTffrance'])->name('account.packages.createTffrance');
    Route::post('create', [PackageController::class, 'store'])->name('account.packages.store');

    Route::get('{package_id}', [PackageController::class, 'show'])->name('account.packages.show');
    Route::put('{package_id}/update_image', [PackageController::class, 'update_image'])->name('account.packages.update_image');
    Route::put('{package_id}/update_info', [PackageController::class, 'update_info'])->name('account.packages.update_info');

    Route::get('import', [PackageController::class, 'import'])->name('account.packages.import');
    Route::post('import', [PackageController::class, 'storage'])->name('account.packages.storage');
});
