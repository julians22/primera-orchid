{{--
    resources/views/components/collection-card.blade.php

    Usage:
    <x-collection-card
        :image="asset('images/regular-orchids.jpg')"
        title="Regular Orchids"
        href="/collections/regular-orchids"
    />

    Multi-word titles wrap onto two lines automatically — pass them as a
    single string, e.g. title="Mini Orchids", title="Special Edition".

    Props:
    - image  (string, required) Background photo
    - title  (string, required) Collection name, shown italic serif
    - href   (string, required) Link target
    - cta    (string, optional) Button label, default "See More"
--}}

@props([
    'image',
    'title',
    'href' => "#",
    'cta' => 'See More',
])

<a
    href="{{ $href }}"
    {{ $attributes->class([
        'group relative block aspect-[3/4] w-full overflow-hidden rounded-2xl',
        'ring-1 ring-black/5 shadow-sm transition duration-300 ease-out hover:shadow-lg',
    ]) }}
>
    {{-- Photo --}}
    <img
        src="{{ $image }}"
        alt="{{ $title }}"
        loading="lazy"
        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500 ease-out"
    />

    {{-- Base gradient so the title always stays legible --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>

    {{-- Teal overlay that deepens on hover, matching the "active" card look --}}
    <div class="absolute inset-0 bg-everglade/0 group-hover:bg-everglade/80 transition duration-300 ease-out"></div>

    {{-- Content --}}
    <div class="bottom-0 absolute inset-x-0 flex flex-col items-start gap-3 p-5">
        <h3 class="drop-shadow-sm font-serif text-white text-4xl italic leading-[1.15]">
            {!! $title !!}
        </h3>

        <span
            class="inline-flex items-center opacity-0 group-hover:opacity-100 px-4 py-1.5 border border-white/80 rounded-full font-medium text-white text-sm transition -translate-y-1 group-hover:translate-y-0 duration-300 ease-out"
        >
            {{ $cta }}
        </span>
    </div>
</a>
