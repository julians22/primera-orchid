@extends('layouts.app')

{{-- Meta SEO Dinamis --}}
@section('meta_title', $meta['title'])
@section('meta_description', $meta['description'])

@section('content')

<section class="z-0 relative bg-white lg:bg-soft-linen-50 py-8 lg:py-20 lg:min-h-[1100px] overflow-y-hidden">

    <div class="lg:hidden block container">
        <img
            src="{{ asset('img/service-banner-mobile.png') }}"
            class="w-full h-auto"
            alt=""
        >
    </div>

    <div
        x-intersect:enter="shown = true"
        x-data="{ shown: false }"
        x-intersect:leave="shown = false"
        class="z-10 relative gap-10 grid grid-cols-1 lg:grid-cols-2 container"
    >
        <div class="flex flex-col gap-y-6 lg:col-start-2 bg-soft-linen-50 lg:bg-transparent px-4 lg:px-0 py-4 lg:py-0 lg:text-left text-center">

            <h1 class="inline-flex flex-col items-center lg:items-start gap-1 lg:gap-4 lg:mt-40 text-everglade">

                <span
                    class="opacity-0 text-lg lg:text-2xl motion-delay-500"
                    :class="shown ? 'animate-opacity-in opacity-100' : 'animate-opacity-out'"
                >
                    {!! __('services.hero.line1') !!}
                </span>

                <span
                    :class="shown ? 'animate-opacity-in opacity-100' : 'animate-opacity-out'"
                    class="opacity-0 font-serif lg:font-semibold font-bold text-3xl lg:text-7xl italic motion-delay-700"
                >
                    {!! __('services.hero.line2') !!}
                </span>

            </h1>

            <span class="inline-block bg-everglade mx-auto lg:mx-0 px-4 lg:px-8 py-2 rounded-full max-w-max font-bold text-white text-lg lg:text-2xl">
                {!! __('services.hero.discount') !!}
            </span>

            <p class="inline-block">
                <span class="font-black text-everglade text-lg lg:text-2xl">
                    {!! __('services.hero.price') !!}
                </span>
                <br>
                <span class="font-bold text-everglade text-base lg:text-lg">
                    {!! __('services.hero.price_unit') !!}
                </span>
            </p>

            <p
                :class="shown ? 'animate-opacity-in' : 'animate-opacity-out'"
                class="text-everglade text-lg lg:text-xl leading-relaxed"
            >
                {!! __('services.hero.description') !!}
            </p>

            <a
                href="{{ whatsapp_link('6280818978781', __('services.hero.whatsapp_message')) }}"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                class="group flex items-center space-x-4 mx-auto lg:mx-0 px-6 py-3 border border-everglade rounded-full w-max text-everglade delay-150"
            >
                <span class="font-semibold">
                    {!! __('services.hero.join_now') !!}
                </span>

                <span class="w-0 group-hover:w-14 transition-all duration-300">
                    <svg
                        id="b"
                        data-name="Layer 2"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 33.55 9.09"
                    >
                        <g id="c" data-name="Layer 1">
                            <path
                                d="m28.01,0c.04,1.23.41,2.93,1.18,4.04H0v1h29.19c-.78,1.14-1.08,2.72-1.19,4.05,1.52-1.86,3.3-3.64,5.55-4.55-2.25-.94-4.11-2.62-5.55-4.54Z"
                                style="fill: #113a3e;"
                            />
                        </g>
                    </svg>
                </span>
            </a>

        </div>
    </div>

    <div class="hidden lg:block bottom-0 z-0 absolute inset-x-0">
        <img
            src="{{ asset('img/service-banner.png') }}"
            alt=""
            class="w-full h-auto"
        >
    </div>

</section>

<section class="bg-white pt-8 lg:pt-20 min-h-36">

    <div
        x-intersect:enter.half="shown = true"
        x-intersect:leave.half="shown = false"
        x-data="{ shown: false }"
    >
        <h3 class="flex flex-col items-center gap-4">
            <span
                class="font-serif font-semibold text-everglade text-3xl lg:text-5xl italic"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
            >
                {!! __('services.how_it_works.title') !!}
            </span>
        </h3>
    </div>


    <div class="mx-auto py-10 border-everglade border-b container">

        <div class="gap-10 lg:gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
            <div
                class="flex flex-col items-center text-center"
                x-intersect:enter.full="shown = true"
                x-intersect:leave.full="shown = false"
                x-data="{ shown: false }"
            >
                <div class="flex flex-col justify-center items-center bg-everglade mb-4 p-4 rounded-full w-40 aspect-square">
                    <picture>
                        <source
                            srcset="{{ asset('img/icon/chat.webp') }}"
                            type="image/webp"
                        >
                        <img
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            class="w-full h-full object-cover motion-delay-200"
                            src="{{ asset('img/icon/chat.png') }}"
                            alt=""
                        >
                    </picture>
                </div>

                <div
                    :class="shown ? 'animate-up-in' : 'animate-up-out'"
                    class="motion-delay-300"
                >
                    <h3 class="mb-2 font-bold text-everglade text-2xl uppercase tracking-wide">
                        {!! __('services.steps.custom_needs.title') !!}
                    </h3>

                    <p class="max-w-[180px] text-everglade text-base leading-relaxed">
                        {!! __('services.steps.custom_needs.description') !!}
                    </p>
                </div>
            </div>

            <div
                class="flex flex-col items-center text-center"
                x-intersect:enter.full="shown = true"
                x-intersect:leave.full="shown = false"
                x-data="{ shown: false }"
            >
                <div class="flex flex-col justify-center items-center bg-everglade mb-4 p-4 rounded-full w-40 aspect-square">
                    <picture>
                        <source
                            srcset="{{ asset('img/icon/truck.webp') }}"
                            type="image/webp"
                        >
                        <img
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            class="w-full h-full object-cover motion-delay-200"
                            src="{{ asset('img/icon/truck.png') }}"
                            alt=""
                        >
                    </picture>
                </div>

                <div
                    :class="shown ? 'animate-up-in' : 'animate-up-out'"
                    class="motion-delay-300"
                >
                    <h3 class="mb-2 font-bold text-everglade text-2xl uppercase tracking-wide">
                        {!! __('services.steps.first_delivery.title') !!}
                    </h3>

                    <p class="max-w-[180px] text-everglade text-base leading-relaxed">
                        {!! __('services.steps.first_delivery.description') !!}
                    </p>
                </div>
            </div>


            <div
                class="flex flex-col items-center text-center"
                x-intersect:enter.full="shown = true"
                x-intersect:leave.full="shown = false"
                x-data="{ shown: false }"
            >
                <div class="flex flex-col justify-center items-center bg-everglade mb-4 p-4 rounded-full w-40 aspect-square">
                    <picture>
                        <source
                            srcset="{{ asset('img/icon/water-can.webp') }}"
                            type="image/webp"
                        >
                        <img
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            class="w-full h-full object-cover motion-delay-200"
                            src="{{ asset('img/icon/water-can.png') }}"
                            alt=""
                        >
                    </picture>
                </div>

                <div
                    :class="shown ? 'animate-up-in' : 'animate-up-out'"
                    class="motion-delay-300"
                >
                    <h3 class="mb-2 font-bold text-everglade text-2xl uppercase tracking-wide">
                        {!! __('services.steps.easy_maintenance.title') !!}
                    </h3>

                    <p class="max-w-[180px] text-everglade text-base leading-relaxed">
                        {!! __('services.steps.easy_maintenance.description') !!}
                    </p>
                </div>
            </div>


            <div
                class="flex flex-col items-center text-center"
                x-intersect:enter.full="shown = true"
                x-intersect:leave.full="shown = false"
                x-data="{ shown: false }"
            >
                <div class="flex flex-col justify-center items-center bg-everglade mb-4 p-4 rounded-full w-40 aspect-square">
                    <picture>
                        <source
                            srcset="{{ asset('img/icon/calendar.webp') }}"
                            type="image/webp"
                        >
                        <img
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            class="w-full h-full object-cover motion-delay-200"
                            src="{{ asset('img/icon/calendar.png') }}"
                            alt=""
                        >
                    </picture>
                </div>

                <div
                    :class="shown ? 'animate-up-in' : 'animate-up-out'"
                    class="motion-delay-300"
                >
                    <h3 class="mb-2 font-bold text-everglade text-2xl uppercase tracking-wide">
                        {!! __('services.steps.routine_replenishment.title') !!}
                    </h3>

                    <p class="max-w-[180px] text-everglade text-base leading-relaxed">
                        {!! __('services.steps.routine_replenishment.description') !!}
                    </p>
                </div>
            </div>

        </div>
    </div>

</section>

<section class="space-y-16 mx-auto px-6 py-12 container">

    @foreach ($services as $service)
        <div x-data="{ shown: false }"
            x-intersect:enter.margin.-5%="shown = true"
            x-intersect:leave="shown = false"
            :class="shown ? 'animate-apple-in' : 'animate-apple-out'">
            <div @if(!$loop->last) class="pb-4 lg:pb-12 border-everglade border-b" @endif>
                <div class="flex sm:flex-row flex-col sm:justify-between sm:items-start gap-3 mb-6">
                    <div>
                        <p class="text-teal-900 text-2xl tracking-[0.15em]">
                            {!! __('services.subscription') !!}
                        </p>

                        <h2 class="-mt-1 font-serif font-semibold text-teal-900 text-5xl italic">
                            {{ trans_field($service, 'title') ?? trans_field($service, 'name') }}
                        </h2>
                    </div>

                    <p class="max-w-2xl font-semibold text-teal-900 sm:text-right leading-relaxed">
                        {{ 
                            trans_field($service, 'description') 
                            ?? data_get($service->description, 'en') 
                            ?? trans_field($service, 'short_description') 
                            ?? data_get($service->short_description, 'en') 
                        }}
                    </p>
                </div>

                <div class="gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($service->items as $item)
                        @php
                            $serviceTitle = trans_field($service, 'title') ?? trans_field($service, 'name');
                            $itemTitle = trans_field($item, 'title') ?? trans_field($item, 'name');

                            $waServiceMessage = str_replace(
                                [':service', ':item'],
                                [$serviceTitle, $itemTitle],
                                __('services.service_item.whatsapp_message')
                            );
                        @endphp

                        <a
                            href="{{ whatsapp_link('6282218181660', $waServiceMessage) }}"
                            class="relative flex flex-col bg-everglade shadow-sm rounded-lg overflow-hidden"
                            target="_blank"
                        >
                            <div class="flex-shrink-0 w-full aspect-[12/8] overflow-hidden">
                                <img
                                    src="{{ asset($item->getFirstMediaUrl('image')) }}"
                                    alt="{{ $itemTitle }}"
                                    class="rounded-lg w-full h-full object-cover"
                                >
                            </div>

                            <div class="flex flex-col justify-center bg-everglade py-3 h-full text-white text-center">
                                <p class="font-bold text-lg">
                                    {{ $itemTitle }}
                                </p>
                                @if ($item->subtitle || trans_field($item, 'subtitle'))
                                    <p class="font-medium text-sm">
                                        {{ trans_field($item, 'subtitle') ?? $item->subtitle }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</section>

<x-customers-section :testimonials="$testimonials" />

<x-subcribe-hero />

@endsection