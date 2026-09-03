<section
    x-intersect:enter.full="shown = true" x-intersect:leave.full="shown = false" x-data="{ shown: false }"
    class="flex items-center bg-cover bg-no-repeat bg-center" style="background-image: url({{asset('img/bg-pattern.jpg')}})">
    <div class="flex flex-col gap-4 mx-auto py-28 max-w-3xl">
        <h3
            :class="shown ? 'animate-up-in' : 'animate-up-out'"
            class="font-serif font-semibold text-everglade text-3xl lg:text-7xl text-center italic">JOIN PRIMERA SUBSCRIPTION!</h3>
        <p
            :class="shown ? 'animate-up-in' : 'animate-up-out'"
            class="text-everglade text-2xl text-center tracking-widest">WE PROVIDE MONTHLY FLOWER MAINTENANCE</p>
        <p
            :class="shown ? 'animate-up-in' : 'animate-up-out'"
            class="block bg-everglade mx-auto px-7 py-3.5 rounded-full w-max font-extrabold text-white">GET 10% OFF FIRST MONTH</p>
        <a
            :class="shown ? 'animate-up-in' : 'animate-up-out'"
            href="#" class="group flex items-center space-x-4 mx-auto px-6 py-3 border border-everglade rounded-full w-max text-everglade">
            <span class="font-semibold">Join Now</span>
            <span class="w-0 group-hover:w-14 transition-all duration-300">
                <?xml version="1.0" encoding="UTF-8"?>
                <svg id="b" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 33.55 9.09">
                    <g id="c" data-name="Layer 1">
                        <path
                            d="m28.01,0c.04,1.23.41,2.93,1.18,4.04H0v1h29.19c-.78,1.14-1.08,2.72-1.19,4.05,1.52-1.86,3.3-3.64,5.55-4.55-2.25-.94-4.11-2.62-5.55-4.54Z"
                            style="fill: #113a3e;" />
                    </g>
                </svg>
            </span>
        </a>
    </div>
</section>
