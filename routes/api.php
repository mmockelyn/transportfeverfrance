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

    Route::group(["prefix" => "accounting"], function () {
        Route::get('/getSalesStat', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'getSalesStat']);
        Route::get('/getSalesAmount', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'getSalesAmount']);
        Route::get('/getPurchaseAmount', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'getPurchaseAmount']);
        Route::get('/getBanksAmount', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'getBankAmount']);
        Route::get('/getPurchaseStat', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'getPurchaseStat']);
        Route::get('/getBalance', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'getBalance']);
        Route::get('/getLastSales', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'getLastSales']);
        Route::get('/getLastPurchase', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'getLastPurchase']);
        Route::get('/getLastBalance', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'getLastBalance']);

        Route::post('/sale', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'addSale']);
        Route::get('/sale/{sale_id}', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'getSale']);
        Route::put('/sale/{sale_id}', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'updateSale']);
        Route::delete('/sale/{sale_id}', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'deleteSale']);

        Route::post('/purchase', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'addPurchase']);
        Route::get('/purchase/{purchase_id}', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'getPurchase']);
        Route::put('/purchase/{purchase_id}', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'updatePurchase']);
        Route::delete('/purchase/{purchase_id}', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'deletePurchase']);

        Route::post('/bank', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'addBank']);
        Route::get('/bank/{bank_id}', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'getBank']);
        Route::put('/bank/{bank_id}', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'updateBank']);
        Route::delete('/bank/{bank_id}', [\App\Http\Controllers\Api\Back\Accounting\AccountingController::class, 'deleteBank']);
    });

    Route::group(["prefix" => "settings"], function () {
        Route::group(["prefix" => "users"], function () {
            Route::delete('{user_id}', [\App\Http\Controllers\Api\Back\Settings\UserController::class, 'delete']);
        });

        Route::group(["prefix" => "cms"], function () {
            Route::post('/add', [\App\Http\Controllers\Api\Back\Settings\PageController::class, 'store']);
            Route::put('/{id}', [\App\Http\Controllers\Api\Back\Settings\PageController::class, 'update']);
            Route::delete('/{id}', [\App\Http\Controllers\Api\Back\Settings\PageController::class, 'delete']);
        });

        Route::group(["prefix" => "social"], function () {
            Route::post('/posting', [\App\Http\Controllers\Api\Back\Settings\SocialController::class, 'posting']);
        });
    });
});

Route::group(["prefix" => "download"], function () {

    Route::get('search/category/{category_id}', [DownloadController::class, 'searchCategory']);
    Route::post('list/categories', [DownloadController::class, 'listCategories']);
    Route::get('list/category/{category_id}/subcategories', [DownloadController::class, 'listSubCategories']);
    Route::get('category/{category_id}', [DownloadController::class, 'category']);
    Route::put('category/{category_id}', [DownloadController::class, 'updateCategory']);
    Route::delete('category/{category_id}', [DownloadController::class, 'deleteCategory']);
    Route::delete('category/{category_id}/sub/{sub_id}', [DownloadController::class, 'deleteSubCategory']);

    Route::get('/{download_id}/feature', [DownloadController::class, 'downloadFeature']);
    Route::put('/{download_id}/feature', [DownloadController::class, 'updateDownloadFeature']);

    Route::get('/{download_id}/publish', [DownloadController::class, 'publishMod']);
    Route::get('/{download_id}/dispublish', [DownloadController::class, 'dispublishMod']);

    Route::post('/{download_id}/auteur', [DownloadController::class, 'addAuthor']);

    Route::group(["prefix" => "{slug}/ticket"], function () {
        Route::get('{ticket_id}', [DownloadController::class, 'getInfoTicket']);
        Route::post('{ticket_id}/composer', [DownloadController::class, 'composer']);
        Route::get('{ticket_id}/close', [DownloadController::class, 'close']);
    });

});

Route::group(["prefix" => "user"], function () {
    Route::post('/', [\App\Http\Controllers\Back\Settings\UserController::class, 'createNewUser'])->name('api.back.settings.user.create');
    Route::post('/export', [\App\Http\Controllers\Back\Settings\UserController::class, 'exportUsers'])->name('api.back.settings.user.export');
    Route::get('{user_id}', [\App\Http\Controllers\Api\Front\UserController::class, 'get']);
    Route::get('{user_id}/inbox', [\App\Http\Controllers\Api\Front\UserController::class, 'inbox']);
    Route::post('{user_id}/packages', [\App\Http\Controllers\Api\Front\UserController::class, 'packages']);

    Route::post('{user_id}/mobile/activate', [\App\Http\Controllers\Account\UserDeviceTokenController::class, 'getDeviceToken']);
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
