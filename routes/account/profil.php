<?php

use App\Http\Controllers\Account\ProfilController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "profil"], function () {
    Route::get('/', [ProfilController::class, 'index'])->name('account.profil');
    Route::put('/update', [ProfilController::class, 'updateUser'])->name('account.profil.update');
});
