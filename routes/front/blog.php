<?php

use App\Http\Controllers\Front\Blog\BlogCommentController;
use App\Http\Controllers\Front\Blog\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "blog"], function () {
    Route::name('front.blog')->get('/', [BlogController::class, 'list']);
    Route::name('front.blog.category')->get('category/{category:slug}', [BlogController::class, 'category']);
    Route::name('front.blog.show')->get('{slug}', [BlogController::class, 'show']);
    Route::name('front.blog.comments')->get('{blog}/comments', [BlogCommentController::class, 'comments']);
    Route::name('front.blog.comment.store')->post('{blog}/comments', [BlogCommentController::class, 'store'])->middleware('auth');
    Route::name('front.blog.comment.destroy')->delete('comments/{comment}', [BlogCommentController::class, 'destroy']);
});
