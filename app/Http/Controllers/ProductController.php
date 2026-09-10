<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() 
    {
        return view('pages.products.index');
    }

    public function collection(string $collection) 
    {
        $locale = app()->getLocale();

        $collection = Collection::where("slug->{$locale}", $collection)
            ->orWhere('slug->en', $collection)
            ->orWhere('slug->id', $collection)
            ->orWhere('id', $collection)
            ->firstOrFail();

        $collection->load('products');
        $collections = Collection::all();

        return view('pages.products.collection', compact('collection', 'collections'));
    }

    public function show(string $product) 
    {
        $locale = app()->getLocale();

        $product = Product::where("slug->{$locale}", $product)
            ->orWhere('slug->en', $product)
            ->orWhere('slug->id', $product)
            ->orWhere('id', $product)
            ->firstOrFail();

        $product->load('collections', 'relatedProducts');
        $relatedProducts = $product->relatedProducts;

        $primaryCollection = $product->collections()->first();

        return view('pages.products.show', compact('product', 'primaryCollection', 'relatedProducts'));
    }
}