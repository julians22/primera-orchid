<header
    class="bg-white" id="header"
        x-data="{ mobileOpen: false }"
        x-effect="document.body.classList.toggle('overflow-hidden', mobileOpen)"
        >

    {{-- ============ DESKTOP TOP BAR (unchanged) ============ --}}
    <div class="hidden lg:block bg-everglade py-4">
        <div class="grid grid-cols-3 mx-auto container">
            <div class="flex gap-x-2 lg:gap-x-4">
                {{-- Social Icons --}}
                <span>
                    <x-si-instagram class="fill-white outline-white size-3 lg:size-5"/>
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
                <span class="font-bold text-white">EN</span>
                <span class="text-white text-sm lg:text-base">|</span>
                <span class="text-white text-sm lg:text-base">ID</span>
            </div>
        </div>
    </div>

    {{-- ============ DESKTOP NAV (unchanged) ============ --}}
    <nav class="menu" :class="{ 'should-fixed': scroll }">
        <div class="mx-auto container">
            {{-- About Us Products Articles CIRCLE(LOGO) Subscription Contact Us {SEARCH BOX} --}}
            <ul class="flex flex-col items-center lg:gap-x-4 lg:grid grid-cols-7">
                <li class="text-center"><a href="{{ route('about') }}" class="font-semibold text-everglade uppercase">About Us</a></li>
                <li class="text-center"><a href="#" class="font-semibold text-everglade uppercase">Products</a></li>
                <li class="text-center"><a href="{{ route('article.index') }}" class="font-semibold text-everglade uppercase">Articles</a></li>
                <li class="hidden lg:block">
                    {{-- Logo Curcle and absolute position half is outside bottom --}}
                    <a href="{{ route('home') }}" class="block relative w-[180px]">
                        <div class="logo-wrapper">
                            <img src="{{ asset('img/logo-persegi.png') }}" class="w-full" alt="" width="230">
                        </div>
                    </a>
                </li>
                <li class="text-center"><a href="{{ route('services') }}" class="font-semibold text-everglade uppercase">Subscription</a></li>
                <li class="text-center"><a href="{{ route('contact') }}" class="font-semibold text-everglade uppercase">Contact Us</a></li>
                <li class="text-center">
                    <div class="relative">
                        <input type="text" class="bg-transparent px-2 py-1 border border-everglade rounded-full focus:outline-none w-32 w-full text-everglade" placeholder="Search">
                        <x-heroicon-o-magnifying-glass class="top-1/2 right-2 absolute size-5 text-everglade -translate-y-1/2 transform"/>
                    </div>
                </li>
            </ul>
        </div>

    </nav>

    {{-- ============ MOBILE NAV (hidden on desktop) ============ --}}
    <div class="lg:hidden relative">

        {{-- Top bar --}}
        <div class="z-20 relative items-center grid grid-cols-3 bg-white px-5 py-5">
            {{-- Hamburger / Close --}}
            <button @click="mobileOpen = !mobileOpen" class="flex flex-col justify-center gap-1.5 w-8" aria-label="Toggle menu">
                <span class="block bg-everglade w-8 h-0.5 transition-transform duration-200"
                      :class="mobileOpen && 'rotate-45 translate-y-2'"></span>
                <span class="block bg-everglade w-8 h-0.5 transition-opacity duration-200"
                      :class="mobileOpen && 'opacity-0'"></span>
                <span class="block bg-everglade w-8 h-0.5 transition-transform duration-200"
                      :class="mobileOpen && '-rotate-45 -translate-y-2'"></span>
            </button>

            {{-- Landscape logo, shown only when menu is closed --}}
            <div class="relative col-span-2" x-show="!mobileOpen">
                <a href="{{ route('home') }}" class="flex justify-center bg-everglade ml-auto px-4 py-2 rounded-2xl">
                    <img src="{{ asset('img/logo-persegi.png') }}" class="h-12 object-cover" alt="Primera Orchid">
                </a>
            </div>
        </div>

        {{-- Circle logo (open state only), overlapping top bar / panel boundary --}}
        <div
            x-show="mobileOpen"
            x-transition:enter="transition ease-out duration-200 delay-75"
            x-transition:enter-start="opacity-0 scale-75"
            x-transition:enter-end="opacity-100 scale-100"
            class="top-16 left-1/2 z-30 absolute flex justify-center size-32 -translate-x-1/2 -translate-y-1/2"
            style="display:none;"
        >
            <a href="{{ route('home') }}" class="flex justify-center items-center bg-everglade border-4 border-white rounded-full size-full">
                <img src="{{ asset('img/logo-persegi.png') }}" class="w-20" alt="Primera Orchid">
            </a>
        </div>

        {{-- Dropdown panel --}}
        <div
            x-show="mobileOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="top-0 z-10 fixed inset-x-0 bg-everglade px-6 pt-36 pb-10"
            style="display:none;"
        >
            <ul class="flex flex-col items-center gap-y-7">
                <li><a href="{{ route('about') }}" class="font-bold text-white text-2xl uppercase">About Us</a></li>
                <li><a href="#" class="font-bold text-white text-2xl uppercase">Products</a></li>
                <li><a href="{{ route('article.index') }}" class="font-bold text-white text-2xl uppercase">Articles</a></li>
                <li><a href="{{ route('services') }}" class="font-bold text-white text-2xl uppercase">Subscription</a></li>
                <li><a href="{{ route('contact') }}" class="font-bold text-white text-2xl uppercase">Contact Us</a></li>
            </ul>

            <div class="flex justify-center items-center gap-x-2 mt-8 font-bold text-white text-lg">
                <span class="pb-0.5 border-white border-b-2">EN</span>
                <span>|</span>
                <span>ID</span>
            </div>

            <div class="flex justify-center items-center gap-x-6 mt-6">
                <span><x-si-instagram class="fill-white outline-white size-6"/></span>
                <span><x-si-facebook class="fill-white outline-white size-6"/></span>
                <span><x-si-youtube class="fill-white outline-white size-6"/></span>
            </div>
        </div>

    </div>
</header>
