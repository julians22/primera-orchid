<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Product;
use App\Models\PageSetting;

class ProductController extends Controller
{
    public function index() 
    {
        $locale = app()->getLocale();
        $collections = Collection::all();

        $meta = $this->getMeta();
        return view('pages.products.index', compact('collections', 'meta'));
    }

    private function getMeta(): array
    {
        $locale = app()->getLocale();

        $seoRecord = PageSetting::where('page_key', 'collections')
            ->where('section_key', 'seo_meta')
            ->first();

        $payload = $seoRecord?->payload ?? [];

        $getString = function ($value) use ($locale) {
            if (is_string($value)) {
                return $value;
            }

            if (is_array($value)) {
                return $value[$locale]
                    ?? $value['en']
                    ?? reset($value)
                    ?? '';
            }

            return '';
        };

        $title = $getString(
            $payload["meta_title_{$locale}"]
                ?? $payload['meta_title_en']
                ?? null
        );

        $description = $getString(
            $payload["meta_description_{$locale}"]
                ?? $payload['meta_description_en']
                ?? null
        );

        return [
            'title' => $title ?: 'Collections',
            'description' => $description ?: 'Contact Primera Orchid for more information.',
        ];
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