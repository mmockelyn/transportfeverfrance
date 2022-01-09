<?php

use App\Http\Controllers\Front\Blog\BlogCommentController;
use App\Http\Controllers\Front\Blog\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "wiki"], function () {
    Route::name('front.wiki')->get('/', [\App\Http\Controllers\Front\Wiki\WikiController::class, 'index']);
    Route::name('front.wiki.category')->get('/{wiki_category_id}', [\App\Http\Controllers\Front\Wiki\WikiController::class, 'category']);
    Route::name('front.wiki.show')->get('/article/{wiki:slug}', [\App\Http\Controllers\Front\Wiki\WikiController::class, 'show']);
});
