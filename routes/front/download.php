<?php

use App\Http\Controllers\Front\Blog\BlogCommentController;
use App\Http\Controllers\Front\Blog\BlogController;
use App\Http\Controllers\Front\Download\DownloadController;
use App\Http\Controllers\Front\Download\DownloadSupportController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "download"], function () {
    Route::name('front.download.category')->get('category/{subcategory:id}', [DownloadController::class, 'category']);
    Route::name('front.download.show')->get('{slug}', [DownloadController::class, 'show']);

    Route::name('front.download.comment.store')->post('{slug}/comment', [DownloadController::class, 'storeComment']);
    Route::get('{slug}/comment/{comment_id}/report', [DownloadController::class, 'reportComment']);
    Route::post('{slug}/comment/reply', [DownloadController::class, 'replyComment']);
    Route::name('front.download.comment.delete')->delete('{slug}/comment/{comment_id}/delete', [DownloadController::class, 'deleteComment']);

    Route::group(["prefix" => '{slug}/ticket'], function () {
        Route::name('front.download.ticket.new')->post('/', [DownloadSupportController::class, 'newSupport']);

        Route::name('front.download.ticket.room')->get('{id}', [DownloadSupportController::class, 'show']);
    });
});
