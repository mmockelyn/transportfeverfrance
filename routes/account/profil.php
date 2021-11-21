<?php

use App\Http\Controllers\Account\ProfilController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "profil", "middleware" => ["web"]], function () {
    Route::get('/', [ProfilController::class, 'index'])->name('account.profil');
    Route::put('/update', [ProfilController::class, 'updateUser'])->name('account.profil.update');
    Route::put('/update/avatar', [ProfilController::class, 'updateAvatar'])->name('account.profil.avatar');
    Route::put('/update/password', [ProfilController::class, 'updatePassword'])->name('account.profil.password');
    Route::delete('/', [ProfilController::class, 'deleteAccount'])->name('account.profil.delete');
    Route::get('/delete/cancel', [ProfilController::class, 'deleteCancelAccount'])->name('account.profil.delete.cancel');
});
