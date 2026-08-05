@extends('layouts.app')

@section('content')

<section class="relative py-20 min-h-36">
    <header class="z-10 relative section-header-collection">
        <div class="collection-wrapper">
            {!! collection_hero_renderer($primaryCollection->body_content) !!}
        </div>
    </header>
    <picture>
        <img class="absolute inset-0 w-full h-full object-bottom object-cover" src="{{ asset('img/collection-1.png') }}" alt="">
    </picture>
</section>

<section class="relative py-10 min-h-36">

    <!-- Breadcrumbs -->
    <div class="z-10 relative mx-auto mb-10 container">
        <x-utils.breadcrumbs
            class="text-xl"
            :items="[
                ['label' => 'Home', 'href' => url('/')],
                ['label' => $primaryCollection->name, 'href' => route('collection.show', $primaryCollection->slug)],
                ['label' => $product->name],
            ]"
        />
    </div>


    <!-- Product Details -->
    <div class="z-10 relative mx-auto container" id="product-{{ $product->slug }}">
        <div class="gap-10 grid grid-cols-1 md:grid-cols-2">
            <div>
                <img src="{{ asset('img/product-3.jpg') }}" alt="{{ $product->name }}" class="rounded-xl w-full object-cover aspect-[4/5]">
            </div>
            <div class="flex flex-col gap-y-6">
                <h1>
                    <span class="block font-bold text-3xl">{{ $primaryCollection->name }}</span>
                    <span class="font-bold text-everglade text-6xl leading-snug">{{ $product->name }}</span>
                </h1>

                <!-- Divider -->
                <div class="bg-everglade rounded-full w-full h-px"></div>

                <div>
                    {!! $product->body_content !!}
                </div>

                <!-- Divider -->
                <div class="bg-everglade rounded-full w-full h-px"></div>

            </div>
        </div>
    </div>


</section>

<section class="relative py-10 min-h-36">

    <!-- You might also like -->
    <div class="mx-auto container">
        <div class="flex justify-between items-end gap-x-10 mb-10">

            <!-- Title -->
            <div>
                <h2 class="inline-flex flex-col items-start gap-4">
                    <span class="font-serif font-semibold text-everglade text-4xl italic">YOU MIGHT LIKE</span>
                </h2>
            </div>
            <!-- Horizontal Line -->
            {{-- <div class="bg-everglade rounded-full w-full h-px"></div> --}}

        </div>
    </div>

    <!-- Collection Card Grid -->
    <div class="mx-auto container">

        <div class="gap-6 grid grid-cols-4">

            @foreach($relatedProducts as $relatedProduct)
                <x-product-card
                    :image="asset('img/product-3.jpg')"
                    :name="$relatedProduct->name"
                    :href="route('product.show', $relatedProduct->slug)"
                />

            @endforeach

        </div>

    </div>

</section>



@endsection
