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
Route::get('/list/download/comment/{user}', [\App\Http\Controllers\Api\Front\UserController::class, 'downloadComment']);
Route::get('/list/blog/comment/{user}', [\App\Http\Controllers\Api\Front\UserController::class, 'blogComment']);

Route::group(["prefix" => "back"], function () {
    Route::post('publishing', [\App\Http\Controllers\Api\Back\BackController::class, 'publishing']);
    Route::post('unpublishing', [\App\Http\Controllers\Api\Back\BackController::class, 'unpublishing']);

    Route::group(["prefix" => 'blog'], function () {
        Route::delete('{id}/comments/{comment_id}', [\App\Http\Controllers\Api\Back\Blog\BlogController::class, 'delete']);
    });
});

Route::group(["prefix" => "download"], function () {

    Route::get('search/category/{category_id}', [DownloadController::class, 'searchCategory']);
    Route::post('list/categories', [DownloadController::class, 'listCategories']);
    Route::get('list/category/{category_id}/subcategories', [DownloadController::class, 'listSubCategories']);

    Route::group(["prefix" => "{slug}/ticket"], function () {
        Route::get('{ticket_id}', [DownloadController::class, 'getInfoTicket']);
        Route::post('{ticket_id}/composer', [DownloadController::class, 'composer']);
        Route::get('{ticket_id}/close', [DownloadController::class, 'close']);
    });

});

Route::group(["prefix" => "user"], function () {
    Route::get('{user_id}', [\App\Http\Controllers\Api\Front\UserController::class, 'get']);
    Route::get('{user_id}/inbox', [\App\Http\Controllers\Api\Front\UserController::class, 'inbox']);
    Route::post('{user_id}/packages', [\App\Http\Controllers\Api\Front\UserController::class, 'packages']);
});

Route::group(["prefix" => "calendar"], function () {
    Route::get('list', [\App\Http\Controllers\Api\Back\CalendarController::class, 'list']);
    Route::post('/', [\App\Http\Controllers\Api\Back\CalendarController::class, 'store']);
    Route::put('{id}', [\App\Http\Controllers\Api\Back\CalendarController::class, 'update']);
    Route::delete('{id}', [\App\Http\Controllers\Api\Back\CalendarController::class, 'delete']);
});

Route::group(["prefix" => "tasks"], function () {
    Route::get('/list', [\App\Http\Controllers\Api\Back\TaskController::class, 'list']);
    Route::post('/', [\App\Http\Controllers\Api\Back\TaskController::class, 'store']);
});

Route::group(["prefix" => "blog"], function () {
    Route::group(["prefix" => "category"], function () {
        Route::post('/', [\App\Http\Controllers\Api\Back\Blog\BlogCategoryController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\Back\Blog\BlogCategoryController::class, 'info']);
        Route::put('{id}', [\App\Http\Controllers\Api\Back\Blog\BlogCategoryController::class, 'update']);
        Route::delete('{id}', [\App\Http\Controllers\Api\Back\Blog\BlogCategoryController::class, 'delete']);
    });
});
