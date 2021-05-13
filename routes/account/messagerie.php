<?php

use App\Http\Controllers\Account\BadgeController;
use App\Http\Controllers\Account\MessagerieController;
use App\Http\Controllers\Account\ProfilController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "messagerie"], function () {
    Route::get('/', [MessagerieController::class, 'index'])->name('account.messagerie');
    Route::get('/sent', [MessagerieController::class, 'sentbox'])->name('account.messagerieSent');

    Route::post('compose', [MessagerieController::class, 'sending'])->name('account.messagerie.sending');

    Route::get('{message_id}', [MessagerieController::class, 'show'])->name('account.messagerie.view');
    Route::post('{message_id}/compose', [MessagerieController::class, 'viewCompose'])->name('account.messagerie.view.compose');

    Route::delete('{message_id}', [MessagerieController::class, 'delete']);
});
