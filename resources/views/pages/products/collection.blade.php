@extends('layouts.app')

@section('content')

<section class="relative py-8 lg:py-20 min-h-36 ;g">
    <header class="z-10 relative section-header-collection">
        <div class="collection-wrapper">
            {!! collection_hero_renderer($collection->body_content) !!}
        </div>
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
                ['label' => 'Home', 'href' => url('/')],
                ['label' => 'Collections', 'href' => route('collection.index')],
                ['label' => $collection->name],
            ]"
        />
    </div>


    <!-- Products -->
    <div class="z-10 relative mx-auto scroll-m-20 container" id="products-{{ $collection->slug }}">
        <div class="gap-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($collection->products as $product)
                <x-product-card
                    :image="asset('img/product-3.jpg')"
                    :name="$product->name"
                    :href="route('product.show', $product->slug)"
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
                    <span class="text-2xl">OUR</span>
                    <span class="decorative-title">COLLECTIONS</span>
                </h2>
            </div>
            <!-- Horizontal Line -->
            <div class="bg-everglade rounded-full w-full h-px"></div>

        </div>
    </div>

    <!-- Collection Card Grid -->
    <div class="mx-auto container">

        <div class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">

            {{-- Collection Card --}}
            {{-- Current Active Card, should have # Link Ancor --}}
            @foreach ($collections as $collection_item)

                <x-collection-card
                    :image="$collection_item->getFirstMediaUrl('thumbnail', 'webp_format') ?? asset('img/placeholder.png')"
                    :title="$collection_item->name"
                    :href="$collection_item->slug == $collection->slug ? '#products-'.$collection->slug : route('collection.show', $collection_item->slug)"
                />

            @endforeach

        </div>

    </div>

</section>

<x-subcribe-hero/>


@endsection
