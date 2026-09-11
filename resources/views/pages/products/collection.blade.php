@extends('layouts.app')

@php
    $isId = app()->getLocale() === 'id';
@endphp

@section('content')

<section class="relative py-8 lg:py-20 min-h-36">
    <header class="z-10 relative section-header-collection">
        @if ($collection && trans_field($collection, 'body_content'))
            <div class="collection-wrapper">
                {!! collection_hero_renderer(trans_field($collection, 'body_content')) !!}
            </div>
        @endif
    </header>
    <picture>
        <img class="absolute inset-0 w-full h-full object-bottom object-cover" src="{{ asset('img/collection-1.png') }}" alt="">
    </picture>
</section>

<section class="relative py-8 lg:py-20 min-h-36">

    <!-- Breadcrumbs -->
    <div class="z-10 relative mx-auto mb-10 container">
        <x-utils.breadcrumbs
            class="text-xl"
            :items="[
                ['label' => app()->getLocale() === 'id' ? 'Beranda' : 'Home', 'href' => url('/')],
                ['label' => app()->getLocale() === 'id' ? 'Koleksi' : 'Collections', 'href' => $isId ? url('/koleksi') : route('collection.index')],
                ['label' => trans_field($collection, 'name') ?? trans_field($collection, 'title')],
            ]"
        />
    </div>

    <!-- Products -->
    <div class="z-10 relative mx-auto scroll-m-20 container" id="products-{{ trans_field($collection, 'slug') }}">
        <div class="gap-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($collection->products as $product)
                <x-product-card
                    :image="asset('img/product-3.jpg')"
                    :name="trans_field($product, 'name')"
                    :href="route('product.show', trans_field($product, 'slug') ?? $product->id)"
                />
            @endforeach
        </div>
    </div>

</section>

<!-- Collection Section -->
<section class="bg-white py-8 lg:py-20 min-h-36">

    <div class="mx-auto container">
        <div class="flex justify-between items-end gap-x-10 mb-10">

            <!-- Title -->
            <div>
                <h2 class="inline-flex flex-col items-start gap-4">
                    <span class="text-2xl">{{ app()->getLocale() === 'id' ? 'KOLEKSI' : 'OUR' }}</span>
                    <span class="decorative-title">{{ app()->getLocale() === 'id' ? 'KAMI' : 'COLLECTIONS' }}</span>
                </h2>
            </div>
            <!-- Horizontal Line -->
            <div class="bg-everglade rounded-full w-full h-px"></div>

        </div>
    </div>

    <!-- Collection Card Grid -->
    <div class="mx-auto container">

        <div class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">

            @foreach ($collections as $collection_item)
                @php
                    $itemSlug = trans_field($collection_item, 'slug') ?? $collection_item->id;
                    $currentSlug = trans_field($collection, 'slug') ?? $collection->id;
                    $isActive = $itemSlug === $currentSlug || $collection_item->id === $collection->id;
                @endphp

                <x-collection-card
                    :image="$collection_item->getFirstMediaUrl('thumbnail', 'webp_format') ?? asset('img/placeholder.png')"
                    :title="\Str::upper(trans_field($collection_item, 'name') ?? trans_field($collection_item, 'title'))"
                    :href="$isActive ? '#products-'.$currentSlug : route('collection.show', $itemSlug)"
                />
            @endforeach

        </div>

    </div>

</section>

<x-subcribe-hero/>

@endsection