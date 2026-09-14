<!-- Collection Section -->
<section
    class="bg-white py-8 lg:py-20 min-h-36">

    <div class="mx-auto container">
        <div class="flex justify-between items-center lg:items-end gap-x-10 mb-10">

            <div>
                <!-- Title Desktop -->
                <div x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }">
                    <h2 class="hidden lg:inline-flex flex-col items-start gap-4">
                        <span class="text-2xl"
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            >{{ trans('components.ourCollections.line1') }}</span>
                        <span class="decorative-title"
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            >{{ trans('components.ourCollections.line2') }}</span>
                    </h2>
                </div>
                <!-- Title Mobile -->
                <div x-intersect:enter="shown = true" x-intersect:leave="shown = false" x-data="{ shown: false }">
                    <h2 class="lg:hidden inline-flex flex-col items-start gap-1 lg:gap-4">
                        <span class="text-2xl"
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            >{{ trans('components.ourCollections.line1') }}</span>
                        <span class="decorative-title"
                            :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            >{{ trans('components.ourCollections.line2') }}</span>
                    </h2>
                </div>
            </div>
            <!-- Horizontal Line -->
            <div class="bg-everglade rounded-full w-full h-px"></div>

        </div>
    </div>

    <!-- Collection Card Grid -->
    <div class="mx-auto container">

        <div class="gap-6 grid grid-cols-1 lg:grid-cols-4">

            @foreach ($collections as $collection)
                <x-collection-card
                    :image="$collection->getFirstMediaUrl('thumbnail', 'webp_format') ?? asset('img/placeholder.png')"
                    :title="\Str::upper(trans_field($collection, 'name'))"
                    :href="route('collection.show', trans_field($collection, 'slug') ?? $collection->id)"
                />
            @endforeach

        </div>

    </div>

</section>