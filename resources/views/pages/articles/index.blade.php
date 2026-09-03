@extends('layouts.app')

@section('content')

<section class="relative py-8 lg:py-20 min-h-36">

    <!-- Breadcrumbs -->
    <div class="z-10 relative mx-auto mb-10 container">
        <x-utils.breadcrumbs
            class="text-xl"
            :items="[
                ['label' => 'Home', 'href' => url('/')],
                ['label' => 'Articles', 'href' => route('article.index')],
                ['label' => 'All Articles'],
            ]"
        />
    </div>

    <!-- Articles -->
    <div class="z-10 relative mx-auto scroll-m-20 container">

        <div class="gap-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($articles as $article)
            <!-- Article Card 1-->
            <article
                x-intersect.once="shown = true"
                x-data="{ shown: false }"
                class="flex flex-col gap-4 bg-soft-linen-50 rounded-2xl overflow-hidden">
                <div class="rounded-xl w-full aspect-[20/9] overflow-hidden">
                    <img src="{{ asset('img/article-1.png') }}" alt="" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col gap-2 px-8 py-4">
                    <p class="text-everglade text-sm"
                        :class="shown ? 'animate-up-in' : 'animate-up-out'"
                    >{{ $article->categories->first()->title ?? '' }}</p>
                    <h3 class="font-semibold text-everglade text-2xl"
                        :class="shown ? 'animate-up-in' : 'animate-up-out'"
                        >{{ $article->title }}</h3>

                    <!-- Line -->
                    <div class="bg-everglade rounded-full w-full h-px"></div>

                    <!-- Description -->
                    <p class="text-everglade"
                        :class="shown ? 'animate-up-in' : 'animate-up-out'"
                    >{{ $article->short_description }}</p>

                    <!-- Read More Button -->
                    <a href="{{ route('article.show', $article->slug) }}"
                        :class="shown ? 'animate-up-in' : 'animate-up-out'"
                        class="flex items-center space-x-4 px-2 py-1 border border-everglade rounded-full w-max text-everglade">
                        <span class="font-semibold">Read More</span>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $articles->links() }}
        </div>

    </div>


</section>

<x-subcribe-hero/>

@endsection
