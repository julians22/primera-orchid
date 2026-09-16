<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;
use App\Models\PageSetting;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
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

        $services = Service::with('items')->get();

        $meta = $this->getMeta();

        $howItWorks = $this->getHowItWorks();

        return view(
            'pages.services',
            compact(
                'services',
                'testimonials',
                'meta',
                'howItWorks'
            )
        );
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
            'title' => $title ?: 'Subscription',
            'description' => $description ?: 'Welcome to Primera Orchid official website.',
        ];
    }

    private function getHowItWorks(): array
    {
        $locale = app()->getLocale();

        $record = PageSetting::where('page_key', 'subscription')
            ->where('section_key', 'how_it_works')
            ->first();

        $payload = $record->payload ?? [];

        /*
        |--------------------------------------------------------------------------
        | Default data
        |--------------------------------------------------------------------------
        |
        | Ini dibuat sama dengan template original.
        | Kalau data dari Filament kosong, website tetap menggunakan
        | translation lama.
        |
        */

        $defaultSteps = [
            1 => [
                'icon' => asset('img/icon/chat.png'),
                'icon_webp' => asset('img/icon/chat.webp'),
                'title' => __('services.steps.custom_needs.title'),
                'description' => __('services.steps.custom_needs.description'),
            ],

            2 => [
                'icon' => asset('img/icon/truck.png'),
                'icon_webp' => asset('img/icon/truck.webp'),
                'title' => __('services.steps.first_delivery.title'),
                'description' => __('services.steps.first_delivery.description'),
            ],

            3 => [
                'icon' => asset('img/icon/water-can.png'),
                'icon_webp' => asset('img/icon/water-can.webp'),
                'title' => __('services.steps.easy_maintenance.title'),
                'description' => __('services.steps.easy_maintenance.description'),
            ],

            4 => [
                'icon' => asset('img/icon/calendar.png'),
                'icon_webp' => asset('img/icon/calendar.webp'),
                'title' => __('services.steps.routine_replenishment.title'),
                'description' => __('services.steps.routine_replenishment.description'),
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Section title
        |--------------------------------------------------------------------------
        */

        $sectionTitle = $payload["section_title_{$locale}"]
            ?? $payload['section_title_en']
            ?? __('services.how_it_works.title');

        if (empty($sectionTitle)) {
            $sectionTitle = __('services.how_it_works.title');
        }

        /*
        |--------------------------------------------------------------------------
        | Build steps
        |--------------------------------------------------------------------------
        */

        $steps = [];

        for ($i = 1; $i <= 4; $i++) {
            $iconPath = $payload["step{$i}_icon"] ?? null;

            $title = $payload["step{$i}_title_{$locale}"]
                ?? $payload["step{$i}_title_en"]
                ?? null;

            $description = $payload["step{$i}_desc_{$locale}"]
                ?? $payload["step{$i}_desc_en"]
                ?? null;

            /*
             * Kalau Filament punya icon:
             * subscription/icons/example.png
             *
             * maka menjadi:
             * /storage/subscription/icons/example.png
             */
            $icon = !empty($iconPath)
                ? asset('storage/' . ltrim($iconPath, '/'))
                : $defaultSteps[$i]['icon'];

            $steps[] = [
                'icon' => $icon,

                /*
                 * Kalau icon berasal dari Filament, kita tidak punya
                 * versi WebP otomatis. Jadi WebP hanya digunakan
                 * untuk fallback/default icon.
                 */
                'icon_webp' => !empty($iconPath)
                    ? null
                    : $defaultSteps[$i]['icon_webp'],

                /*
                 * Jangan pakai nl2br() di Blade.
                 *
                 * Translation kamu sudah mempunyai:
                 * CUSTOM<br>YOUR NEEDS
                 */
                'title' => !empty($title)
                    ? $title
                    : $defaultSteps[$i]['title'],

                'description' => !empty($description)
                    ? $description
                    : $defaultSteps[$i]['description'],
            ];
        }

        return [
            'section_title' => $sectionTitle,
            'steps' => $steps,
        ];
    }
}