<header class="bg-white">
    <nav class="bg-everglade py-4">
        <div class="grid grid-cols-3 mx-auto container">
            <div class="flex gap-x-4">
                {{-- Social Icons --}}
                <span>
                    <x-si-instagram class="fill-white outline-white size-5"/>
                </span>
                <span>
                    <x-si-x class="fill-white outline-white size-5"/>
                </span>
                <span>
                    <x-si-facebook class="fill-white outline-white size-5"/>
                </span>
                <span>
                    <x-si-youtube class="fill-white outline-white size-5"/>
                </span>
            </div>

            <div class="text-center">
                <p class="font-extrabold text-white text-sm">#1 INDONESIAN MINI ORCHIDS IN A BOX</p>
            </div>

            <div class="flex justify-end space-x-1">
                <span class="font-bold text-white">EN</span>
                <span class="text-white">|</span>
                <span class="text-white">ID</span>
            </div>
        </div>
    </nav>


    <nav class="py-4">
        <div class="mx-auto container">
            {{-- About Us Products Articles CIRCLE(LOGO) Subscription Contact Us {SEARCH BOX} --}}
            <ul class="items-center grid grid-cols-7">
                <li class="px-6 text-center"><a href="#" class="font-semibold text-everglade uppercase">About Us</a></li>
                <li class="px-6 text-center"><a href="#" class="font-semibold text-everglade uppercase">Products</a></li>
                <li class="px-6 text-center"><a href="#" class="font-semibold text-everglade uppercase">Articles</a></li>
                <li class="">
                    {{-- Logo Curcle and absolute position half is outside bottom --}}
                    <div class="relative w-[180px]">
                        <div class="-top-4 left-0 z-10 absolute flex justify-center items-center bg-everglade px-8 rounded-full w-full aspect-square overflow-hidden">
                            <img src="{{ asset('img/logo-persegi.png') }}" class="w-full" alt="" width="230">
                        </div>
                    </div>
                </li>
                <li class="px-6 text-center"><a href="#" class="font-semibold text-everglade uppercase">Subscription</a></li>
                <li class="px-6 text-center"><a href="#" class="font-semibold text-everglade uppercase">Contact Us</a></li>
                <li class="px-6 text-center">
                    <div class="relative">
                        <input type="text" class="bg-transparent pb-1 border border-everglade rounded-full focus:outline-none w-32 text-everglade" placeholder="Search">
                        {{-- <x-heroicon-o-magnifying-glass class="top-0 right-0 absolute size-5 text-everglade"/> --}}
                    </div>
                </li>
            </ul>
        </div>

    </nav>
</header>
