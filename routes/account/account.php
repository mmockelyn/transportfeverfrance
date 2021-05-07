<?php

use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "account", "middleware" => ["web"]], function () {
    include("profil.php");
    include("badge.php");
    include("notification.php");
});


