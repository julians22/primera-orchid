@extends('layouts.app')

@section('content')
<section class="relative py-8 lg:py-20 min-h-36">
    <picture>
        <img class="absolute inset-0 w-full h-full object-bottom object-cover" src="{{ asset('img/collection-1.png') }}" alt="">
    </picture>
</section>

<section class="bg-white py-8 lg:py-20 min-h-36">
    <!-- Collection Card Grid -->
    <div class="mx-auto container">

        <div class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">

            @foreach ($collections as $collection)
                <x-collection-card
                    :image="$collection->getFirstMediaUrl('thumbnail', 'webp_format') ?? asset('img/placeholder.png')"
                    :title="\Str::upper(trans_field($collection, 'name'))"
                    :href="route('collection.show', trans_field($collection, 'slug') ?? $collection->id)"
                />
            @endforeach

        </div>

    </div>

</section>

<x-subcribe-hero/>

@endsection