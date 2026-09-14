@extends('layouts.app')

{{-- Meta SEO Dinamis --}}
@section('meta_title', $meta['title'])
@section('meta_description', $meta['description'])

@section('content')
<section class="relative py-8 lg:py-20 min-h-36">
    <picture>
        <img class="absolute inset-0 w-full h-full object-bottom object-cover" src="{{ asset('img/collection-1.png') }}" alt="">
    </picture>
</section>

<x-collection-card-section :collections="$collections" />

<x-subcribe-hero/>

@endsection