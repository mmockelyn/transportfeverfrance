<?php

use App\Http\Controllers\Front\Blog\BlogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\PageController;
use Illuminate\Support\Facades\Route;

Route::name('auth.login.provider')->get('login/{provider}', [\App\Http\Controllers\Auth\LoginSocialController::class, 'redirectToProvider']);
Route::name('auth.login.provider.callback')->get('login/{provider}/callback', [\App\Http\Controllers\Auth\LoginSocialController::class, 'handleProviderCallback']);
