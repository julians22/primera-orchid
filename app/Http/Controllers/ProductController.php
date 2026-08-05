<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        return view('pages.products.index');
    }

    public function collection(string $collection) {

        $collection = Collection::where('slug->en', $collection)->firstOrFail();
        $collection->load('products');

        $collections = Collection::all();

        return view('pages.products.collection', compact('collection', 'collections'));
    }

    public function show(string $product) {

        $product = Product::where('slug->en', $product)->firstOrFail();
        $product->load('collections', 'relatedProducts');
        $relatedProducts = $product->relatedProducts;

        // primary collection for the product
        $primaryCollection = $product->collections()->first();

        return view('pages.products.show', compact('product', 'primaryCollection', 'relatedProducts'));
    }
}
