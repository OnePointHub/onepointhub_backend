<?php

use App\Http\Controllers\Helpdesk\FaqController;
use App\Http\Controllers\Helpdesk\KbArticleController;
use App\Http\Controllers\Helpdesk\KbCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        // Helpdesk Module Routes
        Route::prefix('helpdesk')->group(function () {

            // Helpdesk KB Articles Routes
            Route::prefix('kb')->group(function () {
                Route::name('kbarticles.')->group(function () {
                    Route::controller(KbArticleController::class)->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/{kbArticle}', 'show')->name('show');
                        Route::post('/', 'store')->name('store');
                        Route::put('/{kbArticle}', 'update')->name('update');
                        Route::delete('/{kbArticle}', 'destroy')->name('destroy');
                        Route::put('/{kbArticle}/attach/{kbCategory}', 'attach')->name('attach');
                        Route::put('/{kbArticle}/detach/{kbCategory}', 'detach')->name('detach');
                        Route::put('/{kbArticle}/publish/{publishDate?}', 'publish')->name('publish');
                        Route::put('/{kbArticle}/unpublish', 'unpublish')->name('unpublish');
                    });
                });
            });

            // Helpdesk KB Article Categories
            Route::prefix('categories')->group(function () {
                Route::name('kbcategories.')->group(function () {
                    Route::controller(KbCategoryController::class)->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/{kbCategory}', 'show')->name('show');
                        Route::post('/', 'store')->name('store');
                        Route::put('/{kbCategory}', 'update')->name('update');
                        Route::delete('/{kbCategory}', 'destroy')->name('destroy');
                        Route::put('/{kbCategory}/attach/{kbArticle}', 'attach')->name('attach');
                        Route::put('/{kbCategory}/detach/{kbArticle}', 'detach')->name('detach');
                    });
                });
            });

            // Helpdesk FAQs
            Route::prefix('faq')->group(function () {
                Route::name('faq.')->group(function () {
                    Route::controller(FaqController::class)->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/{faq}', 'show')->name('show');
                        Route::post('/', 'store')->name('store');
                        Route::put('/{faq}', 'update')->name('update');
                        Route::delete('/{faq}', 'destroy')->name('destroy');
                        Route::put('/{faq}/publish/{publishDate?}', 'publish')->name('publish');
                        Route::put('/{faq}/unpublish', 'unpublish')->name('unpublish');
                    });
                });
            });
        });
    });
});
