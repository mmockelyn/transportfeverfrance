<?php

use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "account", "middleware" => ["verified"]], function () {
    include("profil.php");
});


