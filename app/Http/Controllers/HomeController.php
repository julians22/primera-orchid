<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\PageSetting;
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
            
        $testimonials = Testimonial::where('is_active', true)->get();

        if ($testimonials->isEmpty()) {
            $testimonials = collect([
                [
                    'avatar'   => asset('img/customer-1.png'),
                    'name'     => 'Ayu Putri',
                    'location' => 'Surabaya, Indonesia',
                    'content'  => [
                        'en' => 'I am absolutely delighted with the orchids I received from Primera Orchids! The quality and freshness of the blooms exceeded my expectations. The arrangement was stunning, and it brought so much joy to my home. I highly recommend Primera Orchids for anyone looking for exquisite floral arrangements.',
                        'id' => 'Saya sangat senang dengan anggrek yang saya terima dari Primera Orchids! Kualitas dan kesegaran bunganya melebihi ekspektasi saya. Rangkaian bunganya sangat memukau dan membawa kebahagiaan di rumah saya.',
                    ],
                ],
                [
                    'avatar'   => asset('img/customer-1.png'),
                    'name'     => 'Bella Nabella',
                    'location' => 'Jakarta, Indonesia',
                    'content'  => [
                        'en' => 'Primera Orchids never disappoints! The orchids I ordered were delivered promptly and in perfect condition. The blooms were vibrant and long-lasting, and the arrangement was simply beautiful. I am extremely satisfied with my purchase and will definitely order again!',
                        'id' => 'Primera Orchids tidak pernah mengecewakan! Anggrek yang saya pesan dikirim dengan cepat dan dalam kondisi sempurna. Bunganya cerah dan tahan lama, serta rangkaian bunganya sangat indah.',
                    ],
                ],
            ]);
        }

        $meta = $this->getMeta();
        $heroSlides = $this->getHeroSlides();

        return view('welcome', compact('best_seller_products', 'collections', 'latest_articles', 'testimonials', 'meta', 'heroSlides'));
    }

    private function getMeta(): array
    {
        $locale = app()->getLocale();

        $seoRecord = PageSetting::where('page_key', 'home')
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
            'title' => $title ?: 'Primera Orchid - Home',
            'description' => $description ?: 'Welcome to Primera Orchid official website.',
        ];
    }

    private function getHeroSlides(): array
    {
        $heroRecord = PageSetting::where('page_key', 'home')
            ->where('section_key', 'hero')
            ->first();

        $slides = $heroRecord->payload['slides'] ?? [];

        if (empty($slides)) {
            $defaultSlide = [
                    'image_desktop'  => null,
                    'image_mobile'   => null,
                    'heading_en'     => 'PREMIUM FRESH ORCHIDS, <br>CRAFTED WITH PASSION IN SURABAYA',
                    'heading_id'     => 'PREMIUM FRESH ORCHIDS, <br>CRAFTED WITH PASSION IN SURABAYA',
                    'title_en'       => 'ORCHIDS PERFECTION',
                    'title_id'       => 'ORCHIDS PERFECTION',
                    'subtitle_en'    => 'At Primera Orchids, every bloom is thoughtfully curated to bring beauty, freshness, and refinement into your space.',
                    'subtitle_id'    => 'At Primera Orchids, every bloom is thoughtfully curated to bring beauty, freshness, and refinement into your space.',
                    'button_text_en' => 'Discover Now',
                    'button_text_id' => 'Discover Now',
                    'button_url'     => '#',
            ];

            return array_fill(0, 4, $defaultSlide);
        }

        return $slides;
    }
}
