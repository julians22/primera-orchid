{{--
    resources/views/components/product-card.blade.php

    Usage:
    <x-product-card
        :image="asset('images/mini-orchids.jpg')"
        name="Mini Orchids Magnolia"
        :price="45.00"
        href="/products/mini-orchids-magnolia"
    />

    Props:
    - image  (string, required) URL of the product photo
    - name   (string, required) Product title shown under the photo
    - price  (float|null, optional) If provided, shown next to the name
    - href   (string|null, optional) Wraps the card in a link when provided
--}}

@props([
    'image',
    'name',
    'price' => null,
    'href' => null,
])

@php
    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if($href) href="{{ $href }}" @endif
    {{ $attributes->class([
        'group block w-full',
        'transition duration-200 ease-out hover:-translate-y-0.5',
    ]) }}
>
    {{-- Photo --}}
    <div class="bg-neutral-50 rounded-xl overflow-hidden">
        <img
            src="{{ $image }}"
            alt="{{ $name }}"
            loading="lazy"
            class="w-full object-cover aspect-[4/5] group-hover:scale-105 transition duration-300 ease-out"
        />
    </div>

    {{-- Title / price --}}
    <div class="mt-3 px-1 pb-1 text-center">
        <h3 class="font-bold text-everglade text-lg leading-snug">
            {{ $name }}
        </h3>

        @if(!is_null($price))
            <p class="mt-1 font-semibold text-neutral-500 text-sm">
                ${{ number_format($price, 2) }}
            </p>
        @endif
    </div>
</{{ $tag }}>
