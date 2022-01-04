<?php

use App\Http\Controllers\Front\Blog\BlogCommentController;
use App\Http\Controllers\Front\Blog\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "wiki"], function () {
    Route::name('front.wiki')->get('/', [\App\Http\Controllers\Front\Wiki\WikiController::class, 'index']);
});
