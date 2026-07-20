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
                        <div class="relative col-span-5 pb-6" data-swiper-parallax="-500"
                            data-swiper-parallax-duration="600" data-swiper-parallax-opacity="0">
                            <div class="bottom-10 absolute flex flex-col gap-2">
                                <p class="text-everglade-500 text-lg">PREMIUM FRESH ORCHIDS, <br>CRAFTED WITH PASSION IN SURABAYA</p>
                                <h3 class="font-serif font-semibold text-everglade-500 text-8xl italic">ORCHIDS PERFECTION</h3>
                                <p class="text-everglade-500 text-lg">At Primera Orchids, every bloom is thoughtfully curated to
                                    bring beauty, freshness, and refinement into your space.</p>

                                <a href="#" class="group flex items-center space-x-4 px-6 py-3 border border-everglade rounded-full w-max text-everglade">
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
<section class="min-h-36">

</section>

<!-- New Collection section -->
<section class="bg-cover bg-no-repeat bg-center w-full aspect-[20/7]" style="background-image: url({{asset('img/bg-flower.png')}})">
    <div class="grid grid-cols-12 mx-auto container">
        <div class="flex flex-col gap-4 col-span-4 col-start-7 pt-40">
            <p class="text-white text-xl">NEW COLLECTION</p>
            <h2 class="font-serif text-white text-7xl italic">CHRISTMAS EDITION</h2>
            <p class="text-white">Wrapped in warmth, graced with elegance our orchids for your Christmas season. Elevate your holiday moments with the serene beauty of Christmas orchids.</p>

            <a href="#" class="group flex items-center space-x-4 px-6 py-3 border border-white rounded-full w-max text-white">
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

<section class="min-h-36">

</section>

<x-subcribe-hero/>

<section class="bg-white py-20 min-h-36">

    <h3 class="flex flex-col items-center gap-4">
        <span class="text-2xl">LOVED BY</span>
        <span class="font-serif font-semibold text-everglade text-5xl italic">OUR CUSTOMERS</span>
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

<section class="bg-neutral-100 py-20 min-h-36">

    <div class="mx-auto container">
        <div class="flex justify-between items-center mb-10">

            <!-- Title -->
            <div>
                <h2 class="font-serif font-semibold text-everglade text-5xl italic">ARTICLE & TIPS</h2>
                <p class="text-lg">WE SHARE THE LATEST TIPS AND ARTICLES ON ORCHID CARE</p>
            </div>

            <!-- Button See More -->
            <div>
                <a href="#" class="group flex items-center space-x-4 px-6 py-3 border border-everglade rounded-full w-max text-everglade">
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

        <div class="gap-6 grid grid-cols-3">

            <!-- Article Card 1-->
            <article class="flex flex-col gap-4 bg-white rounded-2xl overflow-hidden">
                <div class="rounded-xl w-full aspect-[20/9] overflow-hidden">
                    <img src="{{ asset('img/article-1.png') }}" alt="" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col gap-2 px-8 py-4">
                    <p class="text-everglade text-sm">Tips & Tricks</p>
                    <h3 class="font-semibold text-everglade text-2xl">5 Beginner-Friendly Orchid Care Tips</h3>

                    <!-- Line -->
                    <div class="bg-everglade rounded-full w-full h-px"></div>

                    <!-- Description -->
                    <p class="text-everglade">Learn the essential tips and tricks to keep your orchids healthy and thriving. From watering techniques to light requirements, we've got you covered.</p>

                    <!-- Read More Button -->
                    <a href="#" class="flex items-center space-x-4 px-2 py-1 border border-everglade rounded-full w-max text-everglade">
                        <span class="font-semibold">Read More</span>
                    </a>
                </div>
            </article>

            <!-- Article Card 2-->
            <article class="flex flex-col gap-4 bg-white rounded-2xl overflow-hidden">
                <div class="rounded-xl w-full aspect-[20/9] overflow-hidden">
                    <img src="{{ asset('img/article-2.png') }}" alt="" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col gap-2 px-8 py-4">
                    <p class="text-everglade text-sm">Tips & Tricks</p>
                    <h3 class="font-semibold text-everglade text-2xl">How to make your orchids bloom longer</h3>

                    <!-- Line -->
                    <div class="bg-everglade rounded-full w-full h-px"></div>

                    <!-- Description -->
                    <p class="text-everglade">Learn the key techniques to make your orchids bloom longer. From proper watering to optimal light conditions, we've got you covered.</p>

                    <!-- Read More Button -->
                    <a href="#" class="flex items-center space-x-4 px-2 py-1 border border-everglade rounded-full w-max text-everglade">
                        <span class="font-semibold">Read More</span>
                    </a>
                </div>
            </article>

            <!-- Article Card 3-->
            <article class="flex flex-col gap-4 bg-white rounded-2xl overflow-hidden">
                <div class="rounded-xl w-full aspect-[20/9] overflow-hidden">
                    <img src="{{ asset('img/article-3.png') }}" alt="" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col gap-2 px-8 py-4">
                    <p class="text-everglade text-sm">Tips & Tricks</p>
                    <h3 class="font-semibold text-everglade text-2xl">Avoid These Common Orchid Care Mistakes</h3>

                    <!-- Line -->
                    <div class="bg-everglade rounded-full w-full h-px"></div>

                    <!-- Description -->
                    <p class="text-everglade">Are you making these common orchid care mistakes? Learn how to avoid them and keep your orchids healthy and thriving.</p>

                    <!-- Read More Button -->
                    <a href="#" class="flex items-center space-x-4 px-2 py-1 border border-everglade rounded-full w-max text-everglade">
                        <span class="font-semibold">Read More</span>
                    </a>
                </div>
            </article>




        </div>

    </div>

</section>


@endsection
