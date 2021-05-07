<?php

use App\Http\Controllers\Account\BadgeController;
use App\Http\Controllers\Account\ProfilController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "notify"], function () {
    Route::get('/', [\App\Http\Controllers\Account\NotificationController::class, 'index'])->name('account.notify');
    Route::get('/markAllRead', [\App\Http\Controllers\Account\NotificationController::class, 'markAllRead']);
    Route::get('/allTrash', [\App\Http\Controllers\Account\NotificationController::class, 'allTrash']);
    Route::get('/{notif_id}/read', [\App\Http\Controllers\Account\NotificationController::class, 'readNotif']);
    Route::delete('/{notif_id}/trash', [\App\Http\Controllers\Account\NotificationController::class, 'trashNotif']);
});
