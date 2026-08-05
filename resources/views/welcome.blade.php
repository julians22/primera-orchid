@extends('layouts.app')

@section('content')

<section>
    <!-- Slider main container -->
    <div class="swiper home-swiper"
        style="--swiper-pagination-bottom: 20px; --swiper-pagination-bullet-horizontal-gap: 6px; --swiper-pagination-bullet-inactive-color: transparent; --swiper-pagination-bullet-inactive-opacity: 1; --swiper-border-width: 1px; --swiper-border-color: #113a3e; --swiper-pagination-bullet-width: 14px; --swiper-pagination-bullet-height: 14px;"
        >
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            @for ($i = 0; $i < 4; $i++) <div class="swiper-slide">
                <div class="content-container-wrapper" style="background-image: url({{asset('img/banner-1.jpg')}})">
                    <div class="content-container">
                        <div class="relative col-span-5 pb-6">
                            <div class="bottom-10 absolute flex flex-col gap-2">
                                <p class="text-everglade-500 text-lg motion-duration-700 swiper-animate">PREMIUM FRESH ORCHIDS, <br>CRAFTED WITH PASSION IN SURABAYA</p>
                                <p class="font-serif font-semibold text-everglade-500 text-8xl italic motion-duration-700 motion-delay-200 swiper-animate">ORCHIDS PERFECTION</p>
                                <p class="text-everglade-500 text-lg motion-duration-700 motion-delay-300 swiper-animate">At Primera Orchids, every bloom is thoughtfully curated to
                                    bring beauty, freshness, and refinement into your space.</p>

                                <a href="#" class="group flex items-center space-x-4 px-6 py-3 border border-everglade rounded-full w-max text-everglade motion-duration-1000 motion-delay-300 swiper-animate">
                                    <span class="font-semibold">Discover Now</span>
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
                    </div>
                </div>
        </div>
        @endfor
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
</section>

<!-- Best Seller Sections -->
<section class="bg-white py-20 min-h-36" x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }">
    <div class="mx-auto overflow-hidden container">
        <div class="flex justify-between items-center mb-10">

            <!-- Title -->
            <div>
                <h2 class="inline-flex flex-col items-start gap-4">
                    <span class="text-2xl" :class="shown ? 'animate-up-in' : 'animate-up-out'">OUR</span>
                    <span class="delay-150 decorative-title" :class="shown ? 'animate-up-in' : 'animate-up-out'">BEST SELLER</span>
                </h2>
            </div>

            <!-- Button See More -->
            <div>
                <a href="#"
                    :class="shown ? 'animate-up-in' : 'animate-up-out'"
                    class="group flex items-center space-x-4 px-6 py-3 border border-everglade rounded-full w-max text-everglade delay-150">
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
    </div>

    <!-- Product Card Grid -->
    <div class="mx-auto container">

        <div class="gap-8 grid grid-cols-4">
            @foreach ($best_seller_products as $product)
                <x-product-card
                    :image="asset('img/product-1.jpg')"
                    name="{{ $product->name }}"
                    href="{{ route('product.show', $product->slug) }}"
                />
            @endforeach
        </div>
    </div>

</section>

<!-- New Collection section -->
<section
    x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }"
    class="bg-cover bg-no-repeat bg-center w-full aspect-[20/7]" style="background-image: url({{asset('img/bg-flower.png')}})">
    <div class="grid grid-cols-12 mx-auto container">
        <div class="flex flex-col gap-4 col-span-4 col-start-7 pt-40">
            <p class="text-white text-xl" :class="shown ? 'animate-up-in' : 'animate-up-out'">NEW COLLECTION</p>
            <h2 class="font-serif text-white text-7xl italic delay-100" :class="shown ? 'animate-up-in' : 'animate-up-out'">CHRISTMAS EDITION</h2>
            <p class="text-white delay-150" :class="shown ? 'animate-up-in' : 'animate-up-out'">Wrapped in warmth, graced with elegance our orchids for your Christmas season. Elevate your holiday moments with the serene beauty of Christmas orchids.</p>

            <a href="#"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                class="group flex items-center space-x-4 px-6 py-3 border border-white rounded-full w-max text-white delay-200">
                <span class="font-semibold text-center">Pre Order Now</span>
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

<!-- Collection Section -->
<section
    x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }"
    class="bg-white py-20 min-h-36">

    <div class="mx-auto container">
        <div class="flex justify-between items-end gap-x-10 mb-10">

            <!-- Title -->
            <div>
                <h2 class="inline-flex flex-col items-start gap-4">
                    <span class="text-2xl"
                        :class="shown ? 'animate-up-in' : 'animate-up-out'"
                        >OUR</span>
                    <span class="decorative-title"
                        :class="shown ? 'animate-up-in' : 'animate-up-out'"
                        >COLLECTIONS</span>
                </h2>
            </div>
            <!-- Horizontal Line -->
            <div class="bg-everglade rounded-full w-full h-px"></div>

        </div>
    </div>

    <!-- Collection Card Grid -->
    <div class="mx-auto container">

        <div class="gap-6 grid grid-cols-4">

            @foreach ($collections as $collection)
                <x-collection-card
                    :image="asset('img/product-2.jpg')"
                    title="{{ \Str::upper($collection->name) }}"
                    href="{{ route('collection.show', $collection->slug) }}"
                />
            @endforeach

        </div>

    </div>

</section>

<x-subcribe-hero/>

<section
    x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }"
    class="bg-white py-20 min-h-36">

    <h3 class="flex flex-col items-center gap-4">
        <span class="text-2xl"
            :class="shown ? 'animate-up-in' : 'animate-up-out'"
            >LOVED BY</span>
        <span class="font-serif font-semibold text-everglade text-5xl italic"
            :class="shown ? 'animate-up-in' : 'animate-up-out'"
            >OUR CUSTOMERS</span>
    </h3>

    <div class="mx-auto pt-20 container">

        <div class="flex justify-center gap-4">

            <div class="relative flex bg-soft-linen-100 px-4 pt-16 pb-4 rounded-2xl max-w-2xl">
                <div class="flex flex-col items-center">
                    <!-- Name -->
                    <p class="font-bold text-everglade text-xl">Ayu Putri</p>
                    <!-- Region -->
                    <p class="mb-6 text-everglade text-sm"><i>Surabaya, Indonesia</i></p>
                    <!-- Testimonial -->
                    <p class="text-everglade text-lg">"I am absolutely delighted with the orchids I received from Primera Orchids! The quality and freshness of the blooms exceeded my expectations. The arrangement was stunning, and it brought so much joy to my home. I highly recommend Primera Orchids for anyone looking for exquisite floral arrangements."</p>
                </div>

                <div class="-top-16 left-1/2 absolute inset-x-0 rounded-full w-32 h-32 overflow-hidden -translate-x-1/2">
                    <img src="{{ asset('img/customer-1.png') }}" alt="" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="relative flex bg-soft-linen-100 px-4 pt-16 pb-4 rounded-2xl max-w-2xl">
                <div class="flex flex-col items-center">
                    <!-- Name -->
                    <p class="font-bold text-everglade text-xl">Bella Nabella</p>
                    <!-- Region -->
                    <p class="mb-6 text-everglade text-sm"><i>Jakarta, Indonesia</i></p>
                    <!-- Testimonial -->
                    <p class="text-everglade text-lg">"Primera Orchids never disappoints! The orchids I ordered were delivered promptly and in perfect condition. The blooms were vibrant and long-lasting, and the arrangement was simply beautiful. I am extremely satisfied with my purchase and will definitely order again!"</p>
                </div>

                <div class="-top-16 left-1/2 absolute inset-x-0 rounded-full w-32 h-32 overflow-hidden -translate-x-1/2">
                    <img src="{{ asset('img/customer-1.png') }}" alt="" class="w-full h-full object-cover">
                </div>
            </div>



        </div>


    </div>

</section>

<section class="bg-neutral-100 py-20 min-h-36 overflow-hidden">

    <div class="mx-auto container">
        <div class="flex justify-between items-center mb-10" x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }">

            <!-- Title -->
            <div>
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

        <div class="gap-6 grid grid-cols-3"
            x-intersect:enter.full="shown = true" x-intersect:leave.full="shown = false" x-data="{ shown: false }"
            >

            @foreach ($latest_articles as $article)

                <!-- Article Card {{ $loop->iteration }} -->
                <article class="flex flex-col gap-4 bg-white rounded-2xl overflow-hidden delay-100">
                    <div class="rounded-xl w-full aspect-[20/9] overflow-hidden">
                        <img src="{{ asset('img/article-1.png') }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col gap-2 px-8 py-4">
                        <p class="text-everglade text-sm delay-300"
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            >{{ $article->category }}</p>
                        <h3 class="font-semibold text-everglade text-2xl delay-500"
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            >{{ $article->title }}</h3>

                        <!-- Line -->
                        <div class="bg-everglade rounded-full w-full h-px"></div>

                        <!-- Description -->
                        <p class="text-everglade delay-500"
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                        >Learn the essential tips and tricks to keep your orchids healthy and thriving. From watering techniques to light requirements, we've got you covered.</p>

                        <!-- Read More Button -->
                        <a href="{{ route('article.show', ['article' => $article->slug]) }}"
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            class="flex items-center space-x-4 px-2 py-1 border border-everglade rounded-full w-max text-everglade">
                            <span class="font-semibold">Read More</span>
                        </a>
                    </div>
                </article>

            @endforeach
        </div>

    </div>

</section>


@endsection
