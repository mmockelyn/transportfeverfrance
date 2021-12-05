<?php

use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "account", "middleware" => ["web"]], function () {
    Route::get('/dashboard', [\App\Http\Controllers\Account\AccountController::class, 'dashboard'])->name('account.dashboard');
    include("projet.php");
    include("profil.php");
    include("badge.php");
    include("notification.php");
    include("messagerie.php");
    include("package.php");
});


