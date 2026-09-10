@extends('layouts.app')

@section('content')

<article class="relative pb-10 max-w-none min-h-36 prose prose-sm lg:prose-lg prose-everglade">

    <picture>
        <img src="{{ asset('img/featured_real.png') }}" alt="" class="w-full h-auto object-cover">
    </picture>

    <div class="z-10 relative mx-auto container">

        <div class="space-y-10 mt-10">

            <!-- Title -->
            <h1 class="mx-auto max-w-3xl font-serif font-semibold text-everglade lg:text-7xl text-center italic">
                {{ trans_field($article, 'title') }}
            </h1>

            <!-- Line -->
            <div class="bg-everglade mx-auto rounded-full max-w-3xs h-1"></div>

            <!-- Contents -->
            <div>
                <!-- Description -->
                <p class="text-everglade">
                    {{ trans_field($article, 'short_description') ?? trans_field($article, 'excerpt') }}
                </p>

                <!-- Body Content -->
                {!! trans_field($article, 'body_content') ?? trans_field($article, 'body') !!}
            </div>
        </div>

        @if ($article->tags && $article->tags->isNotEmpty())
            <div>
                Tags: {{ $article->tags->map(fn($tag) => trans_field($tag, 'title') ?? trans_field($tag, 'name'))->filter()->join(', ') }}
            </div>
        @endif
    </div>

</article>

<section class="relative bg-stone-50 py-8 lg:py-20 min-h-36">

    <div class="items-center grid grid-cols-2 container">

        <!-- Previous Article -->
        @if ($article->previousArticle())
            <a href="{{ route('article.show', trans_field($article->previousArticle(), 'slug') ?? $article->previousArticle()->id) }}" class="flex justify-self-start items-center space-x-4 px-2 py-1 border border-everglade rounded-full w-max text-everglade">
                <span class="font-semibold">{{ app()->getLocale() === 'id' ? 'Artikel Sebelumnya' : 'Previous Article' }}</span>
            </a>
        @endif

        <!-- Next Article -->
        @if ($article->nextArticle())
            <a href="{{ route('article.show', trans_field($article->nextArticle(), 'slug') ?? $article->nextArticle()->id) }}" class="flex justify-self-end items-center space-x-4 col-start-2 px-2 py-1 border border-everglade rounded-full w-max text-everglade">
                <span class="font-semibold">{{ app()->getLocale() === 'id' ? 'Artikel Selanjutnya' : 'Next Article' }}</span>
            </a>
        @endif

    </div>

</section>

<x-subcribe-hero/>

@endsection