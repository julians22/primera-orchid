<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactController;
use App\Models\Article;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Livewire\SearchPage;

Route::get('/', HomeController::class)->name('home');

Route::get('tentang-kami', AboutController::class);
Route::get('about', AboutController::class)->name('about');

Route::get('koleksi', [ProductController::class, 'index']);
Route::get('collection', [ProductController::class, 'index'])->name('collection.index');

Route::get('koleksi/{collection}', [ProductController::class, 'collection']);
Route::get('collection/{collection}', [ProductController::class, 'collection'])->name('collection.show');

Route::get('produk/{product}', [ProductController::class, 'show']);
Route::get('product/{product}', [ProductController::class, 'show'])->name('product.show');

Route::get('artikel', [ArticleController::class, 'index']);
Route::get('article', [ArticleController::class, 'index'])->name('article.index');

Route::get('artikel/{article}', [ArticleController::class, 'show']);
Route::get('article/{article}', [ArticleController::class, 'show'])->name('article.show');

Route::get('/search', SearchPage::class)->name('search');

Route::get('kontak', ContactController::class); 
Route::get('contact', ContactController::class) ->name('contact');

Route::get('layanan', ServiceController::class);
Route::get('services', ServiceController::class)->name('services');

Route::post('/subscribe', [NewsletterController::class, 'store'])->name('subscribe');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

// ============ LANG SWITCHER ============
Route::get('lang/{locale}', function (string $locale) {
    if (!in_array($locale, ['en', 'id'])) {
        return redirect()->back();
    }

    $previousLocale = app()->getLocale();
    session()->put('locale', $locale);
    app()->setLocale($locale);

    $previousUrl = url()->previous();
    $path = trim(parse_url($previousUrl, PHP_URL_PATH), '/');

    try {
        $previousRoute = app('router')->getRoutes()->match(app('request')->create($previousUrl));
        $routeName = $previousRoute->getName();

        if ($routeName === 'article.show' || str_starts_with($path, 'artikel/') || str_starts_with($path, 'article/')) {
            $currentSlug = $previousRoute->parameter('article') ?? basename($path);
            $article = Article::where("slug->{$previousLocale}", $currentSlug)
                ->orWhere('slug->en', $currentSlug)
                ->orWhere('slug->id', $currentSlug)
                ->first();

            if ($article) {
                $newSlug = trans_field($article, 'slug');
                $prefix = $locale === 'id' ? 'artikel' : 'article';
                return redirect()->to(url("/{$prefix}/{$newSlug}"));
            }
        }

        if ($routeName === 'collection.show' || str_starts_with($path, 'koleksi/') || str_starts_with($path, 'collection/')) {
            $currentSlug = $previousRoute->parameter('collection') ?? basename($path);
            $collection = Collection::where("slug->{$previousLocale}", $currentSlug)
                ->orWhere('slug->en', $currentSlug)
                ->orWhere('slug->id', $currentSlug)
                ->first();

            if ($collection) {
                $newSlug = trans_field($collection, 'slug');
                $prefix = $locale === 'id' ? 'koleksi' : 'collection';
                return redirect()->to(url("/{$prefix}/{$newSlug}"));
            }
        }

        if ($routeName === 'product.show' || str_starts_with($path, 'produk/') || str_starts_with($path, 'product/')) {
            $currentSlug = $previousRoute->parameter('product') ?? basename($path);
            $product = Product::where("slug->{$previousLocale}", $currentSlug)
                ->orWhere('slug->en', $currentSlug)
                ->orWhere('slug->id', $currentSlug)
                ->first();

            if ($product) {
                $newSlug = trans_field($product, 'slug');
                $prefix = $locale === 'id' ? 'produk' : 'product';
                return redirect()->to(url("/{$prefix}/{$newSlug}"));
            }
        }

        $staticPathMap = [
            'layanan' => ['en' => '/services', 'id' => '/layanan'],
            'services' => ['en' => '/services', 'id' => '/layanan'],

            'tentang-kami' => ['en' => '/about', 'id' => '/tentang-kami'],
            'about' => ['en' => '/about', 'id' => '/tentang-kami'],

            'koleksi' => ['en' => '/collection', 'id' => '/koleksi'],
            'collection' => ['en' => '/collection', 'id' => '/koleksi'],

            'artikel' => ['en' => '/article', 'id' => '/artikel'],
            'article' => ['en' => '/article', 'id' => '/artikel'],

            'kontak' => ['en' => '/contact', 'id' => '/kontak'],
            'contact' => ['en' => '/contact', 'id' => '/kontak'],

            '' => ['en' => '/', 'id' => '/'],
        ];

        if (array_key_exists($path, $staticPathMap)) {
            return redirect()->to(url($staticPathMap[$path][$locale]));
        }

    } catch (\Throwable $e) {
    }

    return redirect()->back();
})->name('lang.switch');