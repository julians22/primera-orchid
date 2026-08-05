<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AboutController extends Controller
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

        return view('pages.about', compact('best_seller_products'));
    }
}
