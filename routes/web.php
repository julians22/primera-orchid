<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Models\Collection;

Route::get('/', HomeController::class)->name('home');
Route::get('about', AboutController::class)->name('about');

Route::prefix('collection')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('collection.index');
    Route::get('/{collection}', [ProductController::class, 'collection'])->name('collection.show');
});

Route::prefix('product')->group(function () {
    Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');
});

Route::prefix('article')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/{article}', [ArticleController::class, 'show'])->name('article.show');
});

Route::get('contact', fn () => view('pages.contact'))->name('contact');
Route::get('services', ServiceController::class)->name('services');

Route::get('lang/{locale}', function (string $locale) {
    if (!in_array($locale, ['en', 'id'])) {
        return redirect()->back();
    }

    $previousLocale = app()->getLocale();
    session()->put('locale', $locale);
    app()->setLocale($locale);

    $previousUrl = url()->previous();
    $previousRoute = app('router')->getRoutes()->match(app('request')->create($previousUrl));

    if ($previousRoute->getName() === 'article.show') {
        $currentSlug = $previousRoute->parameter('article');

        $article = Article::where("slug->{$previousLocale}", $currentSlug)
            ->orWhere('slug->en', $currentSlug)
            ->orWhere('slug->id', $currentSlug)
            ->first();

        if ($article) {
            $newSlug = trans_field($article, 'slug');
            return redirect()->route('article.show', ['article' => $newSlug]);
        }
    }

    if ($previousRoute->getName() === 'collection.show') {
        $currentSlug = $previousRoute->parameter('collection');

        $collection = Collection::where("slug->{$previousLocale}", $currentSlug)
            ->orWhere('slug->en', $currentSlug)
            ->orWhere('slug->id', $currentSlug)
            ->first();

        if ($collection) {
            $newSlug = trans_field($collection, 'slug');
            return redirect()->route('collection.show', ['collection' => $newSlug]);
        }
    }

    return redirect()->back();
})->name('lang.switch');