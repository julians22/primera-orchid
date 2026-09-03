<header
    class="bg-white" id="header">
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
</header>
