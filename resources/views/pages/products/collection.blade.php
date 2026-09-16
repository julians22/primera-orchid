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
            @foreach ($collection->products as $index => $product)
                <div x-data="{ shown: false }"
                    x-intersect:enter.margin.-5%="shown = true"
                    x-intersect:leave="shown = false"
                    :class="shown ? 'animate-apple-in' : 'animate-apple-out'">
                    
                    <x-product-card
                        :image="asset('img/product-3.jpg')"
                        :name="trans_field($product, 'name')"
                        :href="route('product.show', trans_field($product, 'slug') ?? $product->id)"
                    />
                </div>
            @endforeach
        </div>
    </div>

</section>

<!-- Collection Section -->
<x-collection-card-section :collections="$collections" />

<x-subcribe-hero/>

@endsection