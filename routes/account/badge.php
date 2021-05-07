<?php

use App\Http\Controllers\Account\BadgeController;
use App\Http\Controllers\Account\ProfilController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "badge"], function () {
    Route::get('/', [BadgeController::class, 'index'])->name('account.badges');
});
