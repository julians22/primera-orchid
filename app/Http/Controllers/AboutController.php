<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PageSetting;
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

        $meta = $this->getMeta();

        return view('pages.about', compact('best_seller_products', 'meta'));
    }

    private function getMeta(): array
    {
        $locale = app()->getLocale();

        $seoRecord = PageSetting::where('page_key', 'subscription')
            ->where('section_key', 'seo_meta')
            ->first();

        $payload = $seoRecord->payload ?? [];

        $getString = function ($value) use ($locale) {
            if (is_string($value)) {
                return $value;
            }

            if (is_array($value)) {
                return $value[$locale] ?? reset($value) ?? '';
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
            'title' => $title ?: 'About Us',
            'description' => $description ?: 'Welcome to Primera Orchid official website.',
        ];
    }
}
