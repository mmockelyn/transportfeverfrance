<?php

use App\Http\Controllers\Front\Blog\BlogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\PageController;
use Illuminate\Support\Facades\Route;

include('auth.php');
Route::name('home')->get('/', [BlogController::class, 'index']);
Route::resource('contacts', ContactController::class, ['only' => ['create', 'store']]);
Route::name('page')->get('page/{page:slug}', PageController::class);
Route::get('/unlock/tffrance', [\App\Http\Controllers\HomeController::class, 'tffrance']);

Route::group(["prefix" => "donation"], function () {
    Route::get('notify_url', [\App\Http\Controllers\Front\DonationController::class, 'donationNotify'])->name('donation.notify_url');
    Route::get('success', [\App\Http\Controllers\Front\DonationController::class, 'donationSuccess'])->name('donation.success');
    Route::get('cancelled', [\App\Http\Controllers\Front\DonationController::class, 'donationCancelled'])->name('donation.cancelled');
});

include('blog.php');
include('download.php');
