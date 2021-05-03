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

Route::group(["prefix" => "download"], function () {
    Route::get('{slug}/ticket/{ticket_id}', [DownloadController::class, 'getInfoTicket']);
    Route::post('{slug}/ticket/{ticket_id}/composer', [DownloadController::class, 'composer']);
});
