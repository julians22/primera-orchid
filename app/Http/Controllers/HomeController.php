<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $best_seller_products = Product::where('is_best_seller', true)
            ->latest()
            ->take(4)
            ->get();

        $collections = Collection::latest()
            ->take(4)
            ->get();

        $latest_articles = Article::latest()
            ->take(3)
            ->get();

        return view('welcome', compact('best_seller_products', 'collections', 'latest_articles'));
    }
}
