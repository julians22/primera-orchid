<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('about', AboutController::class)->name('about');

Route::group(['prefix' => 'collection'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('collection.index');
    Route::get('/{collection}', [ProductController::class, 'collection'])->name('collection.show');
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');
});

Route::group(['prefix' => 'article'], function () {
    Route::get('/', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/{article}', [ArticleController::class, 'show'])->name('article.show');
});

Route::get('contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('services', ServiceController::class)->name('services');
