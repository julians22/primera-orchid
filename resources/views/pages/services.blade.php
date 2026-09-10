@extends('layouts.app')

@section('content')

<section class="z-0 relative bg-white lg:bg-soft-linen-50 py-8 lg:py-20 lg:min-h-[1100px] overflow-y-hidden">

    <div class="lg:hidden block container">
        <img src="{{ asset('img/service-banner-mobile.png') }}" class="w-full h-auto" alt="">
    </div>

    <div
        x-intersect:enter="shown = true"
        x-data="{ shown: false }"
        x-intersect:leave="shown = false"
        class="z-10 relative gap-10 grid grid-cols-1 lg:grid-cols-2 container">
        <div class="flex flex-col gap-y-6 lg:col-start-2 bg-soft-linen-50 lg:bg-transparent px-4 lg:px-0 py-4 lg:py-0 lg:text-left text-center">

            <h1 class="inline-flex flex-col items-center lg:items-start gap-1 lg:gap-4 lg:mt-40 text-everglade">
                <span class="opacity-0 text-lg lg:text-2xl motion-delay-500"
                    :class="shown ? 'animate-opacity-in opacity-100' : 'animate-opacity-out'"
                >
                    {{ app()->getLocale() === 'id' ? 'PERAWATAN BUNGA BULANAN' : 'MONTHLY FLOWER MAINTENANCE' }}
                </span>

                <span
                    :class="shown ? 'animate-opacity-in opacity-100' : 'animate-opacity-out'"
                    class="opacity-0 font-serif lg:font-semibold font-bold text-3xl lg:text-7xl italic motion-delay-700">
                    {{ app()->getLocale() === 'id' ? 'LANGGANAN PRIMERA' : 'PRIMERA SUBSCRIPTION' }}
                </span>
            </h1>

            <span class="inline-block bg-everglade mx-auto lg:mx-0 px-4 lg:px-8 py-2 rounded-full max-w-max font-bold text-white text-lg lg:text-2xl">
                {{ app()->getLocale() === 'id' ? 'DISKON 10% BULAN PERTAMA' : 'GET 10% OFF FIRST MONTH' }}
            </span>

            <p class="inline-block">
                <span class="font-black text-everglade text-lg lg:text-2xl">IDR 140-200K</span>
                <br>
                <span class="font-bold text-everglade text-base lg:text-lg">
                    {{ app()->getLocale() === 'id' ? 'Per Tanaman' : 'Per Plant' }}
                </span>
            </p>

            <p
                :class="shown ? 'animate-opacity-in' : 'animate-opacity-out'"
                class="text-everglade text-lg lg:text-xl leading-relaxed">
                @if (app()->getLocale() === 'id')
                    Pilihan bunga: putih // Bunga bertahan rata-rata 3-4 minggu // Siklus penggantian yang direkomendasikan: setiap 4 minggu // Termasuk sewa pot gratis // Belum termasuk ongkos kirim // Pelanggan kami meliputi: Vong Kitchen, Alila Hotel, Sopo Del Tower, Home Subscriptions, Oasis
                @else
                    Flower option: white // Flower lasts average of 3-4 Weeks // Recommended change cycle: every 4 weeks // Include free pot rental // Exclude delivery fee // Our customers include: Vong Kitchen, Alila Hotel, Sopo Del Tower, Home Subscriptions, Oasis
                @endif
            </p>

            <!-- Join now -->
            @php
                $joinMessage = app()->getLocale() === 'id'
                    ? 'Halo, saya tertarik dengan Langganan Primera.'
                    : 'Hello, I am interested in the Primera Subscription.';
            @endphp

            <a href="{{ whatsapp_link('6280818978781', $joinMessage) }}"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                class="group flex items-center space-x-4 mx-auto lg:mx-0 px-6 py-3 border border-everglade rounded-full w-max text-everglade delay-150">
                <span class="font-semibold">{{ app()->getLocale() === 'id' ? 'Gabung Sekarang' : 'Join Now' }}</span>
                <span class="w-0 group-hover:w-14 transition-all duration-300">
                    <svg id="b" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.55 9.09">
                        <g id="c" data-name="Layer 1">
                            <path d="m28.01,0c.04,1.23.41,2.93,1.18,4.04H0v1h29.19c-.78,1.14-1.08,2.72-1.19,4.05,1.52-1.86,3.3-3.64,5.55-4.55-2.25-.94-4.11-2.62-5.55-4.54Z" style="fill: #113a3e;" />
                        </g>
                    </svg>
                </span>
            </a>
        </div>
    </div>

    <div class="hidden lg:block bottom-0 z-0 absolute inset-x-0">
        <img src="{{ asset('img/service-banner.png') }}" alt="" class="w-full h-auto">
    </div>

</section>

<section class="bg-white pt-8 lg:pt-20 min-h-36">

    <div x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }">
        <h3 class="flex flex-col items-center gap-4">
            <span class="font-serif font-semibold text-everglade text-3xl lg:text-5xl italic"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
            >
                {{ app()->getLocale() === 'id' ? 'BAGAIMANA CARA KERJANYA?' : 'HOW DOES IT WORKS?' }}
            </span>
        </h3>
    </div>

    <div class="mx-auto py-10 border-everglade border-b container">
        <div class="gap-10 lg:gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">

            <!-- 1. Custom Your Needs -->
            <div class="flex flex-col items-center text-center" x-intersect:enter.full="shown = true" x-intersect:leave.full="shown = false" x-data="{ shown: false }">
                <div class="flex flex-col justify-center items-center bg-everglade mb-4 p-4 rounded-full w-40 aspect-square">
                    <picture>
                        <source srcset="{{ asset('img/icon/chat.webp') }}" type="image/webp">
                        <img :class="shown ? 'animate-up-in' : 'animate-up-out'" class="w-full h-full object-cover motion-delay-200" src="{{ asset('img/icon/chat.png') }}" alt="">
                    </picture>
                </div>
                <div :class="shown ? 'animate-up-in' : 'animate-up-out'" class="motion-delay-300">
                    <h3 class="mb-2 font-bold text-everglade text-2xl uppercase tracking-wide">
                        {!! app()->getLocale() === 'id' ? 'Sesuaikan<br>Kebutuhan' : 'Custom<br>Your Needs' !!}
                    </h3>
                    <p class="max-w-[180px] text-everglade text-base leading-relaxed">
                        {{ app()->getLocale() === 'id' ? 'Beritahu kami kebutuhan & frekuensi penggantian Anda' : 'Tell us your requirement & frequency of change' }}
                    </p>
                </div>
            </div>

            <!-- 2. First Delivery -->
            <div class="flex flex-col items-center text-center" x-intersect:enter.full="shown = true" x-intersect:leave.full="shown = false" x-data="{ shown: false }">
                <div class="flex flex-col justify-center items-center bg-everglade mb-4 p-4 rounded-full w-40 aspect-square">
                    <picture>
                        <source srcset="{{ asset('img/icon/truck.webp') }}" type="image/webp">
                        <img :class="shown ? 'animate-up-in' : 'animate-up-out'" class="w-full h-full object-cover motion-delay-200" src="{{ asset('img/icon/truck.png') }}" alt="">
                    </picture>
                </div>
                <div :class="shown ? 'animate-up-in' : 'animate-up-out'" class="motion-delay-300">
                    <h3 class="mb-2 font-bold text-everglade text-2xl uppercase tracking-wide">
                        {!! app()->getLocale() === 'id' ? 'Pengiriman<br>Pertama' : 'First<br>Delivery' !!}
                    </h3>
                    <p class="max-w-[180px] text-everglade text-base leading-relaxed">
                        {{ app()->getLocale() === 'id' ? 'Kami mengatur pengiriman pertama dan memberikan tips perawatan' : 'We arrange for first delivery and give you care tips' }}
                    </p>
                </div>
            </div>

            <!-- 3. Easy Maintenance -->
            <div class="flex flex-col items-center text-center" x-intersect:enter.full="shown = true" x-intersect:leave.full="shown = false" x-data="{ shown: false }">
                <div class="flex flex-col justify-center items-center bg-everglade mb-4 p-4 rounded-full w-40 aspect-square">
                    <picture>
                        <source srcset="{{ asset('img/icon/water-can.webp') }}" type="image/webp">
                        <img :class="shown ? 'animate-up-in' : 'animate-up-out'" class="w-full h-full object-cover motion-delay-200" src="{{ asset('img/icon/water-can.png') }}" alt="">
                    </picture>
                </div>
                <div :class="shown ? 'animate-up-in' : 'animate-up-out'" class="motion-delay-300">
                    <h3 class="mb-2 font-bold text-everglade text-2xl uppercase tracking-wide">
                        {!! app()->getLocale() === 'id' ? 'Perawatan<br>Mudah' : 'Easy<br>Maintenance' !!}
                    </h3>
                    <p class="max-w-[180px] text-everglade text-base leading-relaxed">
                        {{ app()->getLocale() === 'id' ? 'Anggrek membutuhkan sedikit perawatan. Anda hanya perlu menyiram & memotong bunga layu' : 'Orchid requires little maintenance. You will need to water & trim wilted flowers' }}
                    </p>
                </div>
            </div>

            <!-- 4. Routine Replenishment -->
            <div class="flex flex-col items-center text-center" x-intersect:enter.full="shown = true" x-intersect:leave.full="shown = false" x-data="{ shown: false }">
                <div class="flex flex-col justify-center items-center bg-everglade mb-4 p-4 rounded-full w-40 aspect-square">
                    <picture>
                        <source srcset="{{ asset('img/icon/calendar.webp') }}" type="image/webp">
                        <img :class="shown ? 'animate-up-in' : 'animate-up-out'" class="w-full h-full object-cover motion-delay-200" src="{{ asset('img/icon/calendar.png') }}" alt="">
                    </picture>
                </div>
                <div :class="shown ? 'animate-up-in' : 'animate-up-out'" class="motion-delay-300">
                    <h3 class="mb-2 font-bold text-everglade text-2xl uppercase tracking-wide">
                        {!! app()->getLocale() === 'id' ? 'Pengantian<br>Rutin' : 'Routine<br>Replenishment' !!}
                    </h3>
                    <p class="max-w-[180px] text-everglade text-base leading-relaxed">
                        {{ app()->getLocale() === 'id' ? 'Setiap bulan kami menjadwalkan dan mengirimkan yang segar serta menukar pot lama' : 'Every month we schedule and delivery fresh ones and exchange the old pots' }}
                    </p>
                </div>
            </div>

        </div>
    </div>

</section>

<section class="space-y-16 mx-auto px-6 py-12 container">

    @foreach ($services as $service)
    <div @if(!$loop->last) class="pb-4 lg:pb-12 border-everglade border-b" @endif>
        <div class="flex sm:flex-row flex-col sm:justify-between sm:items-start gap-3 mb-6">
            <div>
                <p class="text-teal-900 text-2xl tracking-[0.15em]">{{ app()->getLocale() === 'id' ? 'LANGGANAN' : 'SUBSCRIPTION' }}</p>
                <h2 class="-mt-1 font-serif font-semibold text-teal-900 text-5xl italic">{{ trans_field($service, 'title') ?? trans_field($service, 'name') }}</h2>
            </div>
            <p class="max-w-2xl font-semibold text-teal-900 sm:text-right leading-relaxed">
                {{ trans_field($service, 'description') ?? trans_field($service, 'short_description') }}
            </p>
        </div>

        <div class="gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">

            @foreach ($service->items as $item)
            @php
                $serviceTitle = trans_field($service, 'title') ?? trans_field($service, 'name');
                $itemTitle = trans_field($item, 'title') ?? trans_field($item, 'name');
                $waServiceMessage = app()->getLocale() === 'id'
                    ? "Halo, saya tertarik dengan layanan {$serviceTitle} - {$itemTitle}"
                    : "Hello, I am interested in {$serviceTitle} - {$itemTitle}";
            @endphp
            
            <a
                href="{{ whatsapp_link('6282218181660', $waServiceMessage) }}"
                class="relative flex flex-col bg-everglade shadow-sm rounded-lg overflow-hidden">
                <div class="flex-shrink-0 w-full aspect-[12/8] overflow-hidden">
                    <img src="{{ asset($item->getFirstMediaUrl('image')) }}" alt="{{ $itemTitle }}" class="rounded-lg w-full h-full object-cover">
                </div>
                <div class="flex flex-col justify-center bg-everglade py-3 h-full text-white text-center">
                    <p class="font-bold text-lg">{{ $itemTitle }}</p>
                    @if ($item->subtitle || trans_field($item, 'subtitle'))
                        <p class="font-medium text-sm">{{ trans_field($item, 'subtitle') ?? $item->subtitle }}</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>

    </div>
    @endforeach

</section>

<x-customers-section />

<x-subcribe-hero/>

@endsection