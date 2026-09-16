@extends('layouts.app')

{{-- Meta SEO Dinamis --}}
@section('meta_title', $meta['title'])
@section('meta_description', $meta['description'])
{{-- @section('meta_keywords', $meta['keywords']) --}}

@section('content')

<x-hero-section :heroSlides="$heroSlides" />

<x-best-seller-section :best_seller_products="$best_seller_products" />

<!-- New Collection section -->
<section
    x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }"
    class="bg-[image:var(--bg-flower)] lg:bg-[image:var(--bg-flower-lg)] bg-cover bg-no-repeat lg:bg-center bg-left w-full aspect-[2/3] lg:aspect-[20/7]"
        style="
            --bg-flower-lg: url({{asset('img/bg-flower.png')}});
            --bg-flower: url({{asset('img/bg-flower-mobile.png')}});
            ">
    <div class="grid grid-cols-12 mx-auto container">
        <div class="flex flex-col gap-4 col-span-12 lg:col-span-4 lg:col-start-7 pt-10 lg:pt-40 pb-10 lg:pb-0">
            <p class="text-white text-xl" :class="shown ? 'animate-up-in' : 'animate-up-out'">{{ __('home.event.line1') }}</p>
            <h2 class="font-serif text-white text-5xl lg:text-7xl italic delay-100" :class="shown ? 'animate-up-in' : 'animate-up-out'">{{ __('home.event.line2') }}</h2>
            <p class="text-white delay-150" :class="shown ? 'animate-up-in' : 'animate-up-out'">{{ __('home.event.line3') }}</p>

            <a href="#"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                class="group flex items-center space-x-4 px-6 py-3 border border-white rounded-full w-max text-white delay-200">
                <span class="font-semibold text-center">{{ __('home.event.line4') }}</span>
                <span class="w-0 group-hover:w-14 transition-all duration-300">
                    <?xml version="1.0" encoding="UTF-8"?>
                    <svg class="fill-white" id="b" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 33.55 9.09">
                        <g id="c" data-name="Layer 1">
                            <path
                                d="m28.01,0c.04,1.23.41,2.93,1.18,4.04H0v1h29.19c-.78,1.14-1.08,2.72-1.19,4.05,1.52-1.86,3.3-3.64,5.55-4.55-2.25-.94-4.11-2.62-5.55-4.54Z" />
                        </g>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>

<x-collection-card-section :collections="$collections" />

<x-subcribe-hero/>

<x-customers-section :testimonials="$testimonials" />

<section class="bg-neutral-100 py-8 lg:py-20 min-h-36 overflow-hidden">

    <div class="mx-auto container">
        <div class="flex justify-between items-center mb-4 lg:mb-10">

            <!-- Title -->
            <div x-intersect:enter="shown = true" x-intersect:leave="shown = false" x-data="{ shown: false }">
                <h2 class="font-serif font-semibold text-everglade text-5xl italic"
                    :class="shown ? 'animate-up-in' : 'animate-up-out'"
                >ARTICLE & TIPS</h2>
                <p class="text-lg"
                    :class="shown ? 'animate-up-in' : 'animate-up-out'"
                >WE SHARE THE LATEST TIPS AND ARTICLES ON ORCHID CARE</p>
            </div>

            <!-- Button See More -->
            <div>
                <a href="{{ route('article.index') }}" class="group flex items-center space-x-4 px-6 py-3 border border-everglade rounded-full w-max text-everglade"
                    :class="shown ? 'animate-up-in' : 'animate-up-out'"
                >
                    <span class="font-semibold">See More</span>
                    <span class="w-0 group-hover:w-14 transition-all duration-300">
                        <?xml version="1.0" encoding="UTF-8"?>
                        <svg id="b" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 33.55 9.09">
                            <g id="c" data-name="Layer 1">
                                <path
                                    d="m28.01,0c.04,1.23.41,2.93,1.18,4.04H0v1h29.19c-.78,1.14-1.08,2.72-1.19,4.05,1.52-1.86,3.3-3.64,5.55-4.55-2.25-.94-4.11-2.62-5.55-4.54Z"
                                    style="fill: #113a3e;" />
                            </g>
                        </svg>
                    </span>
                </a>
            </div>

        </div>

        <div class="gap-6 grid grid-cols-1 lg:grid-cols-3">
            @foreach ($latest_articles as $article)
                <!-- Article Card {{ $loop->iteration }} -->
                <article x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }" class="flex flex-col gap-4 bg-white rounded-2xl overflow-hidden delay-100">
                    <div class="rounded-xl w-full aspect-[20/9] overflow-hidden">
                        <img src="{{ asset('img/article-1.png') }}" alt="{{ trans_field($article, 'title') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col gap-2 px-8 py-4">
                        <p class="text-everglade text-sm delay-300"
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                        >
                            {{ trans_field($article, 'category') }}
                        </p>

                        <h3 class="font-semibold text-everglade text-2xl delay-500"
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                        >
                            {{ trans_field($article, 'title') }}
                        </h3>

                        <!-- Line -->
                        <div class="bg-everglade rounded-full w-full h-px"></div>

                        <!-- Description -->
                        <p class="text-everglade delay-500"
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                        >
                            {{ \Illuminate\Support\Str::limit(strip_tags((string) (trans_field($article, 'excerpt') ?? trans_field($article, 'description') ?? trans_field($article, 'body') ?? 'Learn the essential tips and tricks to keep your orchids healthy and thriving.')), 120) }}
                        </p>

                        <!-- Read More Button -->
                        <a href="{{ route('article.show', ['article' => trans_field($article, 'slug') ?? $article->id]) }}"
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            class="flex items-center space-x-4 px-2 py-1 border border-everglade rounded-full w-max text-everglade">
                            <span class="font-semibold">{{ app()->getLocale() === 'id' ? 'Baca Selengkapnya' : 'Read More' }}</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

    </div>

</section>

@endsection