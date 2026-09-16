@props(['heroSlides' => []])

@php
    $locale = app()->getLocale();
@endphp

<section>
    <div class="swiper home-swiper"
        style="--swiper-pagination-bottom: 20px; --swiper-pagination-bullet-horizontal-gap: 6px; --swiper-pagination-bullet-inactive-color: transparent; --swiper-pagination-bullet-inactive-opacity: 1; --swiper-border-width: 1px; --swiper-border-color: #113a3e; --swiper-pagination-bullet-width: 14px; --swiper-pagination-bullet-height: 14px;">
        
        <div class="swiper-wrapper">
            @foreach ($heroSlides as $slide)
                @php
                    $imgDesktop = !empty($slide['image_desktop']) 
                        ? asset('storage/' . $slide['image_desktop']) 
                        : asset('img/banner-1.jpg');
                        
                    $imgMobile = !empty($slide['image_mobile']) 
                        ? asset('storage/' . $slide['image_mobile']) 
                        : asset('img/banner-1-mobile.png');

                    $line1 = nl2br($slide["heading_{$locale}"] ?? $slide['heading_en'] ?? '');
                    $line2 = nl2br($slide["title_{$locale}"] ?? $slide['title_en'] ?? '');
                    $line3 = nl2br($slide["subtitle_{$locale}"] ?? $slide['subtitle_en'] ?? '');

                    $btnText = $slide["button_text_{$locale}"] ?? $slide['button_text_en'] ?? 'Explore More';
                    $btnUrl  = $slide['button_url'] ?? null;
                @endphp

                <div class="swiper-slide">
                    <div class="content-container-wrapper">
                        <picture>
                            <source media="(min-width: 1024px)" srcset="{{ $imgDesktop }}">
                            <img class="background" src="{{ $imgMobile }}" alt="Hero Banner">
                        </picture>

                        <div class="content-container">
                            <div class="relative lg:col-span-6 pb-6 overflow-hidden">
                                <div class="bottom-28 lg:bottom-10 absolute flex flex-col gap-2">
                                    @if (!empty(trim(strip_tags($line1))))
                                        <p class="text-everglade-500 text-lg motion-duration-700 swiper-animate">
                                            {!! $line1 !!}
                                        </p>
                                    @endif

                                    @if (!empty(trim(strip_tags($line2))))
                                        <p class="font-serif font-semibold text-everglade-500 text-4xl xl:text-6xl 2xl:text-8xl italic motion-duration-700 motion-delay-200 swiper-animate">
                                            {!! $line2 !!}
                                        </p>
                                    @endif

                                    @if (!empty(trim(strip_tags($line3))))
                                        <p class="text-everglade-500 text-lg motion-duration-700 motion-delay-300 swiper-animate">
                                            {!! $line3 !!}
                                        </p>
                                    @endif

                                    @if (!empty($btnUrl))
                                        <a href="{{ $btnUrl }}" class="group flex items-center space-x-4 px-6 py-3 border border-everglade rounded-full w-max text-everglade motion-duration-1000 motion-delay-300 swiper-animate">
                                            <span class="font-semibold">{!! $btnText !!}</span>
                                            <span class="w-0 group-hover:w-14 transition-all duration-300">
                                                <svg id="b" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.55 9.09">
                                                    <g id="c" data-name="Layer 1">
                                                        <path d="m28.01,0c.04,1.23.41,2.93,1.18,4.04H0v1h29.19c-.78,1.14-1.08,2.72-1.19,4.05,1.52-1.86,3.3-3.64,5.55-4.55-2.25-.94-4.11-2.62-5.55-4.54Z" style="fill: #113a3e;" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="swiper-pagination"></div>
    </div>
</section>