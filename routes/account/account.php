<?php

use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "account"], function () {
    include("projet.php");
    include("profil.php");
    include("badge.php");
    include("notification.php");
    include("messagerie.php");
    include("package.php");
});


