@php
    $isId = app()->getLocale() === 'id';
@endphp
<footer class="bg-everglade pt-16 pb-14">

    <div class="flex lg:flex-row flex-col justify-between mx-auto container">
        <div class="flex flex-col gap-4 lg:max-w-1/3">
            <img src="{{ asset('img/logo-persegi.png') }}" alt="" width="230">
            <p class="text-white"><strong>{{ __('components.footer.line1') }}</strong></p>

            <ul class="space-y-4 py-4 border-white border-t border-b">
                <li class="flex gap-3">
                    <x-simpleline-location-pin class="fill-white outline-white size-6"/>
                    <div>
                        <a target="_blank" href="https://maps.app.goo.gl/ABCpDdgJFXedJHVn8" class="text-white :underline">{{ __('components.footer.line2') }}</a>
                    </div>
                </li>
                <li class="flex gap-3">
                    <x-si-whatsapp class="fill-white outline-white size-5"/>
                    <div>
                        <a
                            target="_blank"
                            href="{{ whatsapp_link('6280818978781') }}" class="text-white">0818 978 781</a>
                    </div>
                </li>
            </ul>
        </div>


        <div class="flex flex-col gap-8 lg:max-w-1/3">
            <p class="font-bold text-white text-lg">{{ __('components.footer.line3') }}</p>

            <form action="{{ route('subscribe') }}" method="POST" class="inline-flex lg:flex-row flex-col gap-4">
                @csrf
                <input 
                    type="email" 
                    name="email" 
                    required 
                    class="bg-white px-3 py-1.5 rounded-full focus:outline-none text-black" 
                    placeholder="Email Address"
                >
                <button type="submit" class="px-3 py-1.5 border border-white rounded-full text-white hover:bg-white hover:text-black transition cursor-pointer">
                    Sign up
                </button>
            </form>

            @if (session('success'))
                <p class="text-green-400 text-sm mt-2">{{ session('success') }}</p>
            @endif
            @error('email')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
            @enderror
            <ul class="gap-4 grid grid-cols-3">
                <li><a href="{{ $isId ? url('/tentang-kami') : route('about') }}" class="font-semibold text-white">{{ __('nav.about') }}</a></li>
                <li><a href="{{ $isId ? url('/koleksi') : route('collection.index') }}" class="font-semibold text-white">{{ __('nav.collections') }}</a></li>
                <li><a href="{{ $isId ? url('/artikel') : route('article.index') }}" class="font-semibold text-white">{{ __('nav.articles') }}</a></li>
                <li><a href="{{ $isId ? url('/layanan') : route('services') }}" class="font-semibold text-white">{{ __('nav.subscription') }}</a></li>
                <li><a href="{{ $isId ? url('/kontak') : route('contact') }}" class="font-semibold text-white">{{ __('nav.contact') }}</a></li>
                <li><a href="#" class="font-semibold text-white">Shop</a></li>
            </ul>
        </div>


    </div>


</footer>
