@extends('layouts.app')

@section('content')

<section class="z-0 relative bg-soft-linen-50 py-20 lg:min-h-[1200px] overflow-y-hidden">
    <div class="-top-1/12 left-0 absolute max-w-lg"
        x-intersect:enter="shown = true"
        x-data="{ shown: false }"
        x-intersect:leave="shown = false"
    >
        <img
            :class="shown ? 'animate-opacity-in opacity-100' : 'animate-opacity-out'"
            src="{{ asset('img/flower-shade.png') }}" class="opacity-0 transition-all motion-delay-500" alt="">
    </div>

    <div
        x-intersect:enter="shown = true"
        x-data="{ shown: false }"
        x-intersect:leave="shown = false"
        class="z-10 relative gap-10 grid grid-cols-1 lg:grid-cols-2 container">
        <div class="flex flex-col gap-y-6">

            <h1 class="inline-flex flex-col items-start gap-4 lg:mt-40 text-everglade">
                <span class="opacity-0 text-2xl motion-delay-500"
                    :class="shown ? 'animate-opacity-in opacity-100' : 'animate-opacity-out'"
                    >WE DEDICATED TO BRINGING</span>

                <span
                    :class="shown ? 'animate-opacity-in opacity-100' : 'animate-opacity-out'"
                    class="opacity-0 font-serif font-semibold text-5xl lg:text-7xl italic motion-delay-700">
                    THE TIMELESS
                    ELEGANCE OF
                    ORCHIDS
                </span>

                <span class="text-2xl motion-delay-700"
                    :class="shown ? 'animate-opacity-in' : 'animate-opacity-out'"
                    >INTO EVERYDAY SPACES.</span>
            </h1>

            <p
                :class="shown ? 'animate-opacity-in' : 'animate-opacity-out'"
                class="text-everglade text-xl leading-relaxed">
                Specializing in premium orchid plants and refined
                arrangements, Primera curates each bloom to highlight
                the natural beauty, simplicity, and sophistication that
                orchids represent. With thoughtfully designed packaging
                and carefully selected varieties, Primera transforms
                orchids into meaningful gifts and stylish decorative
                elements for homes, offices, and special occasions.
                <br>
                <br>
                By combining quality plants, elegant presentation, and a
                modern aesthetic, Primera Orchid aims to make the
                beauty of orchids more accessible while celebrating
                nature’s most graceful flower.
            </p>

        </div>
    </div>

    <div class="hidden lg:block bottom-0 z-0 absolute inset-x-0">
        <img src="{{ asset('img/about-flower.png') }}" alt="" class="ml-auto w-full max-w-11/12 h-auto">
    </div>

</section>

<!-- Best Seller Sections -->
<section class="bg-white py-8 lg:py-20 min-h-36">
    <div class="mx-auto container">
        <div class="flex justify-between items-center mb-10">

            <div>
                <!-- Title Desktop -->
                <div x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }">
                    <h2 class="hidden lg:inline-flex flex-col items-start gap-4">
                        <span class="text-2xl" :class="shown ? 'animate-up-in' : 'animate-up-out'">OUR</span>
                        <span class="delay-150 decorative-title" :class="shown ? 'animate-up-in' : 'animate-up-out'">BEST SELLER</span>
                    </h2>
                </div>
                <!-- Title Mobile -->
                <div x-intersect:enter="shown = true" x-intersect:leave="shown = false" x-data="{ shown: false }">
                    <h2 class="lg:hidden inline-flex flex-col items-start gap-2">
                        <span class="text-2xl" :class="shown ? 'animate-up-in' : 'animate-up-out'">OUR</span>
                        <span class="delay-150 decorative-title" :class="shown ? 'animate-up-in' : 'animate-up-out'">BEST SELLER</span>
                    </h2>
                </div>
            </div>

            <!-- Button See More -->
            <div>
                <a href="#"
                    :class="shown ? 'animate-up-in' : 'animate-up-out'"
                    class="group flex items-center space-x-4 px-6 py-3 border border-everglade rounded-full w-max text-everglade">
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

        <div class="gap-8 grid grid-cols-1 lg:grid-cols-4">
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

<x-subcribe-hero/>

@endsection
