@php
    // Localization Nav
    $isId = app()->getLocale() === 'id';


    $productCollections = collect();
    foreach (['\\App\\Models\\ProductCollection', '\\App\\Models\\Collection', '\\App\\Models\\ProductCategory', '\\App\\Models\\Collections'] as $modelClass) {
        if (!class_exists($modelClass)) {
            continue;
        }

        try {
            $candidate = $modelClass::query()->get();
            if ($candidate->isNotEmpty()) {
                $productCollections = $candidate;
                break;
            }
        } catch (\Throwable $e) {
            continue;
        }
    }

    $currentLocale = app()->getLocale();

    $buildCollectionUrl = function ($collection) use ($currentLocale) {
        // Ambil nilai slug berdasarkan JSON locale aktif ('en' atau 'id')
        $rawSlug = $collection->slug ?? $collection->code ?? $collection->title ?? $collection->name ?? $collection->id;

        if (is_string($rawSlug) && (str_starts_with($rawSlug, '{') || str_starts_with($rawSlug, '['))) {
            $decoded = json_decode($rawSlug, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $rawSlug = $decoded[$currentLocale] ?? $decoded['en'] ?? reset($decoded);
            }
        } elseif (is_array($rawSlug)) {
            $rawSlug = $rawSlug[$currentLocale] ?? $rawSlug['en'] ?? reset($rawSlug);
        }

        return url('/collection/' . urlencode((string) $rawSlug));
    };

    $getTranslatableText = function ($model, $attribute) use ($currentLocale) {
        $value = $model->{$attribute} ?? null;

        if (is_string($value) && (str_starts_with($value, '{') || str_starts_with($value, '['))) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded[$currentLocale] ?? $decoded['en'] ?? reset($decoded);
            }
        } elseif (is_array($value)) {
            return $value[$currentLocale] ?? $value['en'] ?? reset($value);
        }

        return $value;
    };
@endphp
@php
    
@endphp
<header
    class="bg-white"
    id="header"
    x-data="{ mobileOpen: false, productOpen: false, searchOpen: false }"
    x-effect="document.body.classList.toggle('overflow-hidden', mobileOpen)"
>

    {{-- ============ DESKTOP TOP BAR ============ --}}
    <div class="hidden lg:block bg-everglade py-4">
        <div class="grid grid-cols-3 mx-auto container">
            <div class="flex gap-x-2 lg:gap-x-4">
                {{-- Social Icons --}}
                <span>
                    <a href="https://www.instagram.com/primeraorchid/" target="_blank" rel="noopener noreferrer">
                        <x-si-instagram class="fill-white outline-white size-3 lg:size-5" />
                    </a>
                </span>
                <span>
                    <x-si-x class="fill-white outline-white size-3 lg:size-5"/>
                </span>
                <span>
                    <x-si-facebook class="fill-white outline-white size-3 lg:size-5"/>
                </span>
                <span>
                    <x-si-youtube class="fill-white outline-white size-3 lg:size-5"/>
                </span>
            </div>

            <div class="text-center">
                <p class="font-extrabold text-[10px] text-white lg:text-sm">#1 INDONESIAN MINI ORCHIDS IN A BOX</p>
            </div>

            <div class="flex justify-end space-x-1">
                <a
                    href="{{ route('lang.switch', 'en') }}"
                    class="text-white {{ $currentLocale === 'en' ? 'font-bold' : 'opacity-80 hover:opacity-100' }}"
                >
                    EN
                </a>
                <span class="text-white text-sm lg:text-base">|</span>
                <a
                    href="{{ route('lang.switch', 'id') }}"
                    class="text-white {{ $currentLocale === 'id' ? 'font-bold' : 'opacity-80 hover:opacity-100' }}"
                >
                    ID
                </a>
            </div>
        </div>
    </div>

    {{-- ============ DESKTOP NAV ============ --}}
    <nav class="menu" :class="{ 'should-fixed': scroll }">
        <div class="mx-auto container">
            {{-- About Us Products Articles CIRCLE(LOGO) Subscription Contact Us {SEARCH BOX} --}}
            <ul class="flex flex-col items-center lg:gap-x-4 lg:grid grid-cols-7">
                <li class="text-center">
                    <a href="{{ $isId ? url('/tentang-kami') : route('about') }}" class="font-semibold text-everglade uppercase">{{ __('nav.about') }}</a>
                </li>

                <li class="group relative text-center">
                    <a href="{{ $isId ? url('/koleksi') : route('collection.index') }}" class="font-semibold text-everglade uppercase transition-colors duration-200 group-hover:text-everglade/80">
                        {{ __('nav.collections') }}
                    </a>

                    @if ($productCollections->isNotEmpty())
                        <div
                            class="absolute left-1/2 top-full z-50 min-w-48 -translate-x-1/2 pt-4 invisible opacity-0 -translate-y-2 pointer-events-none transition-all duration-300 ease-out group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto"
                        >
                            <div class="overflow-hidden rounded-xl border border-everglade/10 bg-white shadow-lg">
                                @foreach ($productCollections as $collection)
                                    @php
                                        $collectionLabel = $getTranslatableText($collection, 'name') 
                                            ?? $getTranslatableText($collection, 'title') 
                                            ?? $getTranslatableText($collection, 'slug') 
                                            ?? $collection->code 
                                            ?? $collection->id;
                                        $collectionUrl = $buildCollectionUrl($collection);
                                    @endphp
                                    <a
                                        href="{{ $collectionUrl }}"
                                        class="block border-b border-everglade/10 px-4 py-3 text-left text-sm font-medium text-everglade transition-all duration-200 ease-out hover:bg-everglade/5 hover:pl-5 last:border-b-0"
                                    >
                                        {{ $collectionLabel }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </li>

                <li class="text-center">
                    <a href="{{ $isId ? url('/artikel') : route('article.index') }}" class="font-semibold text-everglade uppercase">{{ __('nav.articles') }}</a>
                </li>

                <li class="hidden lg:block">
                    {{-- Logo Circle and absolute position half is outside bottom --}}
                    <a href="{{ route('home') }}" class="block relative w-45">
                        <div class="logo-wrapper">
                            <img src="{{ asset('img/logo-persegi.png') }}" class="w-full" alt="" width="230">
                        </div>
                    </a>
                </li>

                <li class="text-center">
                    <a href="{{ $isId ? url('/layanan') : route('services') }}" class="font-semibold text-everglade uppercase">{{ __('nav.subscription') }}</a>
                </li>

                <li class="text-center">
                    <a href="{{ $isId ? url('/kontak') : route('contact') }}" class="font-semibold text-everglade uppercase">{{ __('nav.contact') }}</a>
                </li>

                <li class="text-center">
                    @unless(request()->routeIs('search'))
                        <div class="relative">
                            <form action="{{ route('search') }}" method="GET" class="relative max-w-xs mx-auto" onsubmit="this.querySelector('.search-icon').classList.add('hidden'); this.querySelector('.search-loading').classList.remove('hidden');">
                                <div class="relative">
                                    <input
                                        type="text"
                                        name="query"
                                        class="bg-transparent px-2 py-1 border border-everglade rounded-full focus:outline-none w-full text-everglade placeholder:text-everglade/80"
                                        placeholder="Search"
                                    >

                                    <button type="submit" class="top-1/2 right-2 absolute -translate-y-1/2 transform text-everglade" aria-label="Search">
                                        <svg class="search-icon size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path>
                                        </svg>

                                        <svg class="search-loading hidden size-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endunless
                </li>
            </ul>
        </div>

    </nav>

    {{-- ============ MOBILE NAV (hidden on desktop) ============ --}}
    <div class="lg:hidden relative" @click.outside="searchOpen = false">

        {{-- Top bar --}}
        <div class="z-50 relative items-center grid grid-cols-3 bg-white px-5 py-5">

            {{-- Hamburger / Close --}}
            <button
                @click="
                    mobileOpen = !mobileOpen;
                    if (!mobileOpen) productOpen = false;
                    searchOpen = false;
                "
                class="flex flex-col justify-center gap-1.5 w-8"
                aria-label="Toggle menu"
            >
                <span
                    class="block bg-everglade w-8 h-0.5 transition-all duration-300 ease-out"
                    :class="mobileOpen && 'rotate-45 translate-y-2'"
                ></span>
                <span
                    class="block bg-everglade w-8 h-0.5 transition-all duration-200 ease-out"
                    :class="mobileOpen && 'opacity-0'"
                ></span>
                <span
                    class="block bg-everglade w-8 h-0.5 transition-all duration-300 ease-out"
                    :class="mobileOpen && '-rotate-45 -translate-y-2'"
                ></span>
            </button>

            {{-- Landscape logo, shown only when menu is closed --}}
            <div
                class="relative col-span-1 w-full"
                x-show="!mobileOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
            >
                <a
                    href="{{ $isId ? url('/') : route('home') }}"
                    class="flex justify-center items-center bg-everglade mx-auto rounded-2xl w-full max-w-[180px] h-16 overflow-hidden"
                >
                    <img
                        src="{{ asset('img/logo-persegi.png') }}"
                        class="w-full h-full object-contain px-4"
                        alt="Primera Orchid"
                    >
                </a>
            </div>

            {{-- Mobile Search --}}
             @unless(request()->routeIs('search'))
                <div
                    class="top-0 right-0 z-[60] absolute w-full h-24 pt-2"
                    @click.outside="searchOpen = false"
                >
                    <div
                        x-show="searchOpen"
                        x-transition:enter="transition-opacity duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity duration-300"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute inset-0 bg-white/90 backdrop-blur-md"
                        style="display: none;"
                    ></div>

                    <div class="relative flex justify-end items-center px-5 w-full h-full">
                        <form
                            action="{{ route('search') }}"
                            method="GET"
                            class="relative w-full h-12"
                        >
                            <input
                                type="text"
                                name="query"
                                placeholder="{{ $isId ? 'Cari...' : 'Search...' }}"
                                class="right-0 absolute bg-white px-5 pr-12 border-2 border-everglade rounded-full outline-none h-12 text-everglade placeholder:text-everglade/60 transition-[width,opacity] duration-500 ease-out"
                                :class="searchOpen
                                    ? 'w-full opacity-100'
                                    : 'w-12 opacity-0 pointer-events-none'"
                                x-ref="mobileSearch"
                            >

                            <button
                                type="button"
                                @click="
                                    searchOpen = !searchOpen;
                                    if (searchOpen) {
                                        $nextTick(() => $refs.mobileSearch.focus());
                                    }
                                "
                                class="top-1/2 right-3 z-10 absolute flex justify-center items-center -translate-y-1/2 text-everglade size-6"
                                aria-label="Search"
                            >
                                <svg
                                    class="size-10"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                                    />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endunless
        </div>

        {{-- Circle logo (open state only), overlapping top bar / panel boundary --}}
        <div
            x-show="mobileOpen"
            x-transition:enter="transition ease-out duration-300 delay-75"
            x-transition:enter-start="opacity-0 scale-75"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-75"
            class="top-16 left-1/2 z-50 absolute flex justify-center size-32 -translate-x-1/2 -translate-y-1/2"
            style="display: none;"
        >
            <a
                href="{{ $isId ? url('/') : route('home') }}"
                class="flex justify-center items-center bg-everglade border-4 border-white rounded-full size-full"
            >
                <img
                    src="{{ asset('img/logo-persegi.png') }}"
                    class="w-20"
                    alt="Primera Orchid"
                >
            </a>
        </div>

        {{-- Dropdown panel --}}
        <div
            x-show="mobileOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-250"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="top-0 z-40 fixed inset-x-0 bg-everglade px-6 pt-36 pb-10"
            style="display: none;"
        >
            <ul class="flex flex-col items-center gap-y-7">

                <li>
                    <a
                        href="{{ $isId ? url('/tentang-kami') : route('about') }}"
                        class="font-bold text-white text-2xl uppercase"
                    >
                        {{ __('nav.about') }}
                    </a>
                </li>

                @if ($productCollections->isNotEmpty())
                    <li class="relative z-50">

                        <button
                            @click="productOpen = !productOpen"
                            class="flex items-center gap-x-2 font-bold text-white text-2xl uppercase"
                        >
                            {{ __('nav.collections') }}

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 transition-transform duration-300 ease-out"
                                :class="{ 'rotate-180': productOpen }"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.354a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>

                        <ul
                            x-show="productOpen"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-3 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 -translate-y-3 scale-95"
                            class="relative z-50 mt-2 space-y-2 bg-everglade/90 rounded-lg p-4 text-white text-lg font-semibold shadow-lg origin-top"
                        >
                            @foreach ($productCollections as $collection)
                                @php
                                    $collectionLabel = $getTranslatableText($collection, 'name')
                                        ?? $getTranslatableText($collection, 'title')
                                        ?? $getTranslatableText($collection, 'slug')
                                        ?? $collection->code
                                        ?? $collection->id;

                                    $collectionUrl = $buildCollectionUrl($collection);
                                @endphp

                                <li>
                                    <a
                                        href="{{ $collectionUrl }}"
                                        class="block transition-all duration-200 hover:text-everglade/80 hover:translate-x-1"
                                    >
                                        {{ $collectionLabel }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </li>
                @endif

                <li>
                    <a
                        href="{{ $isId ? url('/artikel') : route('article.index') }}"
                        class="font-bold text-white text-2xl uppercase"
                    >
                        {{ __('nav.articles') }}
                    </a>
                </li>

                <li>
                    <a
                        href="{{ $isId ? url('/layanan') : route('services') }}"
                        class="font-bold text-white text-2xl uppercase"
                    >
                        {{ __('nav.subscription') }}
                    </a>
                </li>

                <li>
                    <a
                        href="{{ $isId ? url('/kontak') : route('contact') }}"
                        class="font-bold text-white text-2xl uppercase"
                    >
                        {{ __('nav.contact') }}
                    </a>
                </li>

            </ul>

            <div class="flex justify-center items-center gap-x-2 mt-8 font-bold text-white text-lg">

                <a
                    href="{{ route('lang.switch', 'en') }}"
                    class="{{ $currentLocale === 'en' ? 'pb-0.5 border-white border-b-2' : 'opacity-80' }}"
                >
                    EN
                </a>

                <span>|</span>

                <a
                    href="{{ route('lang.switch', 'id') }}"
                    class="{{ $currentLocale === 'id' ? 'pb-0.5 border-white border-b-2' : 'opacity-80' }}"
                >
                    ID
                </a>

            </div>

            <div class="flex justify-center items-center gap-x-6 mt-6">

                <span>
                    <a href="https://www.instagram.com/primeraorchid/" target="_blank" rel="noopener noreferrer">
                        <x-si-instagram class="fill-white outline-white size-3 lg:size-5" />
                    </a>
                </span>

                <span>
                    <x-si-facebook class="fill-white outline-white size-6"/>
                </span>

                <span>
                    <x-si-youtube class="fill-white outline-white size-6"/>
                </span>

            </div>

        </div>

    </div>
</header>