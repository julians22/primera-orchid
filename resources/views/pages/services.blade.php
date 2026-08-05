@extends('layouts.app')

@section('content')

<section class="z-0 relative bg-soft-linen-50 py-20 lg:min-h-[1100px] overflow-y-hidden">
    {{-- <div class="-top-1/12 left-0 absolute max-w-lg"
        x-intersect:enter="shown = true"
        x-data="{ shown: false }"
        x-intersect:leave="shown = false"
    >
        <img
            :class="shown ? 'animate-opacity-in opacity-100' : 'animate-opacity-out'"
            src="{{ asset('img/flower-shade.png') }}" class="opacity-0 transition-all motion-delay-500" alt="">
    </div> --}}

    <div
        x-intersect:enter="shown = true"
        x-data="{ shown: false }"
        x-intersect:leave="shown = false"
        class="z-10 relative gap-10 grid grid-cols-2 container">
        <div class="flex flex-col gap-y-6 col-start-2">

            <h1 class="inline-flex flex-col items-start gap-4 lg:mt-40 text-everglade">
                <span class="opacity-0 text-2xl motion-delay-500"
                    :class="shown ? 'animate-opacity-in opacity-100' : 'animate-opacity-out'"
                    >MONTHLY FLOWER MAINTENANCE</span>

                <span
                    :class="shown ? 'animate-opacity-in opacity-100' : 'animate-opacity-out'"
                    class="opacity-0 font-serif font-semibold text-7xl italic motion-delay-700">
                    PRIMERA SUBSCRIPTION
                </span>
            </h1>

            <span class="inline-block bg-everglade px-8 py-2 rounded-full max-w-max font-bold text-white text-2xl">GET 10% OFF FIRST MONTH</span>

            <p class="inline-block">
                <span class="font-black text-everglade text-2xl">IDR 140-200K</span>
                <br>
                <span class="font-bold text-everglade text-lg">Per Plant</span>
            </p>

            <p
                :class="shown ? 'animate-opacity-in' : 'animate-opacity-out'"
                class="text-everglade text-xl leading-relaxed">
                Flower option: white // Flower lasts average of 3-4 Weeks // Recommended
                change cycle: every 4 weeks // Include free pot rental // Exclude delivery fee //
                Our customers include: Vong Kitchen, Alila Hotel, Sopo Del Tower, Home
                Subscriptions, Oasis
            </p>

            <!-- Join now -->
            <a href="#"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                class="group flex items-center space-x-4 px-6 py-3 border border-everglade rounded-full w-max text-everglade delay-150">
                <span class="font-semibold">Join Now</span>
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

    <div class="bottom-0 z-0 absolute inset-x-0">
        <img src="{{ asset('img/service-banner.png') }}" alt="" class="w-full h-auto">
    </div>

</section>

<section
    class="bg-white pt-20 min-h-36">

    <div x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }">
        <h3 class="flex flex-col items-center gap-4">
            <span class="font-serif font-semibold text-everglade text-5xl italic"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                >HOW DOES IT WORKS?</span>
        </h3>
    </div>

    <div class="mx-auto py-10 border-everglade border-b container"
        x-intersect:enter.full="shown = true" x-intersect:leave.full="shown = false" x-data="{ shown: false }"
        >
        <div class="gap-10 lg:gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">

            <!-- 1. Custom Your Needs -->
            <div class="flex flex-col items-center text-center">
                <div class="flex flex-col justify-center items-center bg-everglade mb-4 p-4 rounded-full w-40 aspect-square">
                    <picture>
                        <source srcset="{{ asset('img/icon/chat.webp') }}" type="image/webp">
                        <img :class="shown ? 'animate-up-in' : 'animate-up-out'" class="w-full h-full object-cover motion-delay-200" src="{{ asset('img/icon/chat.png') }}" alt="">
                    </picture>
                </div>
                <div :class="shown ? 'animate-up-in' : 'animate-up-out'" class="motion-delay-300">
                    <h3 class="mb-2 font-bold text-everglade text-2xl uppercase tracking-wide">Custom<br>Your Needs</h3>
                    <p class="max-w-[180px] text-everglade text-base leading-relaxed">
                    Tell us your requirement &amp; frequency of change
                    </p>
                </div>
            </div>

            <!-- 2. First Delivery -->
            <div class="flex flex-col items-center text-center">
                <div class="flex flex-col justify-center items-center bg-everglade mb-4 p-4 rounded-full w-40 aspect-square">
                    <picture>
                        <source srcset="{{ asset('img/icon/truck.webp') }}" type="image/webp">
                        <img :class="shown ? 'animate-up-in' : 'animate-up-out'" class="w-full h-full object-cover motion-delay-200" src="{{ asset('img/icon/truck.png') }}" alt="">
                    </picture>
                </div>
                <div :class="shown ? 'animate-up-in' : 'animate-up-out'" class="motion-delay-300">
                    <h3 class="mb-2 font-bold text-everglade text-2xl uppercase tracking-wide">First<br>Delivery</h3>
                    <p class="max-w-[180px] text-everglade text-base leading-relaxed">
                    We arrange for first delivery and give you care tips
                    </p>
                </div>
            </div>

            <!-- 3. Easy Maintenance -->
            <div class="flex flex-col items-center text-center">
                <div class="flex flex-col justify-center items-center bg-everglade mb-4 p-4 rounded-full w-40 aspect-square">
                    <picture>
                        <source srcset="{{ asset('img/icon/water-can.webp') }}" type="image/webp">
                        <img :class="shown ? 'animate-up-in' : 'animate-up-out'" class="w-full h-full object-cover motion-delay-200" src="{{ asset('img/icon/water-can.png') }}" alt="">
                    </picture>
                </div>
                <div :class="shown ? 'animate-up-in' : 'animate-up-out'" class="motion-delay-300">
                    <h3 class="mb-2 font-bold text-everglade text-2xl uppercase tracking-wide">Easy<br>Maintenance</h3>
                    <p class="max-w-[180px] text-everglade text-base leading-relaxed">
                    Orchid requires little maintenance. You will need to water &amp; trim wilted flowers
                    </p>
                </div>
            </div>

            <!-- 4. Routine Replenishment -->
            <div class="flex flex-col items-center text-center">
                <div class="flex flex-col justify-center items-center bg-everglade mb-4 p-4 rounded-full w-40 aspect-square">
                    <picture>
                        <source srcset="{{ asset('img/icon/calendar.webp') }}" type="image/webp">
                        <img :class="shown ? 'animate-up-in' : 'animate-up-out'" class="w-full h-full object-cover motion-delay-200" src="{{ asset('img/icon/calendar.png') }}" alt="">
                    </picture>
                </div>
                <div :class="shown ? 'animate-up-in' : 'animate-up-out'" class="motion-delay-300">
                    <h3 class="mb-2 font-bold text-everglade text-2xl uppercase tracking-wide">Routine<br>Replenishment</h3>
                    <p class="max-w-[180px] text-everglade text-base leading-relaxed">
                    Every month we schedule and delivery fresh ones and exchange the old pots
                    </p>
                </div>
            </div>

        </div>
    </div>

</section>

<section class="space-y-16 mx-auto px-6 py-12 container">

    @foreach ($services as $service)
    <div
        @if(!$loop->last) class="pb-12 border-everglade border-b" @endif
    >
        <div class="flex sm:flex-row flex-col sm:justify-between sm:items-start gap-3 mb-6">
            <div>
                <p class="text-teal-900 text-2xl tracking-[0.15em]">SUBSCRIPTION</p>
                <h2 class="-mt-1 font-serif font-semibold text-teal-900 text-5xl italic">{{ $service->title }}</h2>
            </div>
            <p class="max-w-2xl font-semibold text-teal-900 sm:text-right leading-relaxed">
                {{ $service->description }}
            </p>
        </div>

        <div class="gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">

            @foreach ($service->items as $item)
            <!-- {{$item->title}} -->
            <div class="flex flex-col bg-everglade shadow-sm rounded-lg overflow-hidden">
                <div class="w-full aspect-[12/8] overflow-hidden">
                    <img src="{{ asset($item->getFirstMediaUrl('image')) }}" alt="" class="rounded-lg w-full h-full object-cover">
                </div>
                <div class="bg-everglade py-3 text-white text-center">
                    <p class="font-bold text-lg">{{ $item->title }}</p>
                    <p class="font-medium text-sm">(Min 2 pots)</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
    @endforeach

</section>

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

<x-subcribe-hero/>

@endsection
