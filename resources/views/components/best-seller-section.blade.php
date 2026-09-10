@props(['best_seller_products'])

<section class="bg-white py-8 lg:py-20 min-h-36">
    <div class="mx-auto overflow-hidden container">
        <div class="flex justify-between items-center mb-4 lg:mb-10">

            <div>
                <!-- Title Desktop -->
                <div x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }">
                    <h2 class="hidden lg:inline-flex flex-col items-start gap-4">
                        <span class="text-2xl" :class="shown ? 'animate-up-in' : 'animate-up-out'">{{ __('components.bestSeller.line1') }}</span>
                        <span class="uppercase delay-150 decorative-title" :class="shown ? 'animate-up-in' : 'animate-up-out'">{{ __('components.bestSeller.line2') }}</span>
                    </h2>
                </div>
                <!-- Title Mobile -->
                <div x-intersect:enter="shown = true" x-intersect:leave="shown = false" x-data="{ shown: false }">
                    <h2 class="lg:hidden inline-flex flex-col items-start gap-2">
                        <span class="text-2xl" :class="shown ? 'animate-up-in' : 'animate-up-out'">{{ __('components.bestSeller.line1') }}</span>
                        <span class="uppercase delay-150 decorative-title" :class="shown ? 'animate-up-in' : 'animate-up-out'">{{ __('components.bestSeller.line2') }}</span>
                    </h2>
                </div>
            </div>

            <!-- Button See More -->
            <div>
                <a href="#"
                    :class="shown ? 'animate-up-in' : 'animate-up-out'"
                    class="group flex items-center space-x-4 px-6 py-3 border border-everglade rounded-full w-max text-everglade delay-150">
                    <span class="font-semibold">See More</span>
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

        </div>
    </div>

    <!-- Product Card Grid -->
    <div class="mx-auto container">

        <div class="gap-8 grid grid-cols-1 lg:grid-cols-4">
            @foreach ($best_seller_products as $product)
                <x-product-card
                    :image="asset('img/product-1.jpg')"
                    :name="trans_field($product, 'name')"
                    :href="route('product.show', trans_field($product, 'slug') ?? $product->id)"
                />
            @endforeach
        </div>
    </div>

</section>