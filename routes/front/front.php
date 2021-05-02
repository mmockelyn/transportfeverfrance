<?php

use App\Http\Controllers\Front\Blog\BlogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\PageController;
use Illuminate\Support\Facades\Route;

include('auth.php');
Route::name('home')->get('/', [BlogController::class, 'index']);
Route::resource('contacts', ContactController::class, ['only' => ['create', 'store']]);
Route::name('page')->get('page/{page:slug}', PageController::class);
include('blog.php');
include('download.php');
