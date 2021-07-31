<?php

use App\Http\Controllers\Front\Blog\BlogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\PageController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "backoffice", "middleware" => ["web", "admin"]], function () {
   Route::get('/', [\App\Http\Controllers\Back\BackController::class, 'index'])->name('dashboard');
   Route::get('changelog', [\App\Http\Controllers\Back\BackController::class, 'changelog'])->name('back.changelog');

   Route::group(["prefix" => "calendar"], function () {
       Route::get('/', [\App\Http\Controllers\Back\CalendarController::class, 'index'])->name('back.calendar.index');
   });

   Route::group(["prefix" => "tasks"], function() {
       Route::get('/', [\App\Http\Controllers\Back\TaskController::class, 'index'])->name('back.tasks.index');
   });

    Route::group(["prefix" => "blogs"], function() {
        Route::get('/', [\App\Http\Controllers\Back\Blog\BlogController::class, 'dashboard'])->name('back.blog.dashboard');

        Route::group(["prefix" => "category"], function () {
            Route::get('/', [\App\Http\Controllers\Back\Blog\BlogCategoryController::class, 'index'])->name('back.blog.category.index');
        });
    });
});
