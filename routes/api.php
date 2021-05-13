<?php

use App\Http\Controllers\Api\Front\DownloadController;
use App\Http\Controllers\Api\Front\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/search', [SearchController::class, 'search']);

Route::post('/download/category/{subcategory_id}', [SearchController::class, 'search_download']);

Route::get('/list/users', [\App\Http\Controllers\Api\Front\UserController::class, "list"]);

Route::group(["prefix" => "download"], function () {
    Route::get('{slug}/ticket/{ticket_id}', [DownloadController::class, 'getInfoTicket']);
    Route::post('{slug}/ticket/{ticket_id}/composer', [DownloadController::class, 'composer']);
    Route::get('{slug}/ticket/{ticket_id}/close', [DownloadController::class, 'close']);
});

Route::group(["prefix" => "user"], function () {
    Route::get('{user_id}', [\App\Http\Controllers\Api\Front\UserController::class, 'get']);
    Route::get('{user_id}/inbox', [\App\Http\Controllers\Api\Front\UserController::class, 'inbox']);
});
