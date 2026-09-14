@extends('layouts.app')

{{-- Meta SEO Dinamis --}}
@section('meta_title', $meta['title'])
@section('meta_description', $meta['description'])

@section('content')

<section class="z-0 relative bg-soft-linen-50 py-8 lg:py-20 lg:min-h-[1200px] overflow-y-hidden">
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
                    >{!! __('about.hero.line1') !!}</span>

                <span
                    :class="shown ? 'animate-opacity-in opacity-100' : 'animate-opacity-out'"
                    class="opacity-0 font-serif font-semibold text-5xl lg:text-7xl italic motion-delay-700">
                    {!! __('about.hero.line2') !!}
                </span>

                <span class="text-2xl motion-delay-700"
                    :class="shown ? 'animate-opacity-in' : 'animate-opacity-out'"
                    >{!! __('about.hero.line3') !!}</span>
            </h1>

            <p
                :class="shown ? 'animate-opacity-in' : 'animate-opacity-out'"
                class="text-everglade text-xl leading-relaxed">
                {!! __('about.hero.line4') !!}
            </p>

        </div>
    </div>

    <div class="hidden lg:block bottom-0 z-0 absolute inset-x-0">
        <img src="{{ asset('img/about-flower.png') }}" alt="" class="ml-auto w-full max-w-11/12 h-auto">
    </div>

</section>

<x-best-seller-section :best_seller_products="$best_seller_products" />

<x-subcribe-hero/>

@endsection
