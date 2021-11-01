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
        Route::group(["prefix" => "category"], function () {
            Route::get('/', [\App\Http\Controllers\Back\Blog\BlogCategoryController::class, 'index'])->name('back.blog.category.index');
        });

        Route::group(["prefix" => "blog"], function () {
            Route::get('/', [\App\Http\Controllers\Back\Blog\BlogController::class, 'dashboard'])->name('back.blog.dashboard');
            Route::get('create', [\App\Http\Controllers\Back\Blog\BlogController::class, 'create'])->name('back.blog.create');
            Route::post('create', [\App\Http\Controllers\Back\Blog\BlogController::class, 'store'])->name('back.blog.store');
            Route::get('{id}', [\App\Http\Controllers\Back\Blog\BlogController::class, 'show'])->name('back.blog.show');
            Route::get('{id}/comments', [\App\Http\Controllers\Back\Blog\BlogController::class, 'comments'])->name('back.blog.comments');
            Route::get('{id}/edit', [\App\Http\Controllers\Back\Blog\BlogController::class, 'edit'])->name('back.blog.edit');
            Route::put('{id}/edit', [\App\Http\Controllers\Back\Blog\BlogController::class, 'update'])->name('back.blog.update');
        });
    });

    Route::group(["prefix" => "packages"], function () {
        Route::group(["prefix" => "category"], function () {
            Route::get('/', [\App\Http\Controllers\Back\Packages\PackageCategoryController::class, 'index'])->name('back.packages.categories');
            Route::post('/', [\App\Http\Controllers\Back\Packages\PackageCategoryController::class, 'store'])->name('back.packages.categories.store');
            Route::post('sub', [\App\Http\Controllers\Back\Packages\PackageCategoryController::class, 'createSubCategory'])->name('back.packages.category.sub.create');
        });
    });

    Route::group(["prefix" => "settings"], function () {
        Route::group(["prefix" => "users"], function () {
            Route::get('/', [\App\Http\Controllers\Back\Settings\UserController::class, 'index'])->name("back.settings.users.index");
            Route::get('{user_id}', [\App\Http\Controllers\Back\Settings\UserController::class, 'show'])->name("back.settings.users.show");
            Route::put('{user_id}/update_profil', [\App\Http\Controllers\Back\Settings\UserController::class, 'updateProfil'])->name("back.settings.users.updateProfil");
        });
    });
});
