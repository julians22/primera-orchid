@props(['howItWorks' => []])

<section class="bg-white pt-8 lg:pt-20 min-h-36">

    <div
        x-intersect:enter.half="shown = true"
        x-intersect:leave.half="shown = false"
        x-data="{ shown: false }"
    >
        <h3 class="flex flex-col items-center gap-4">
            <span
                class="font-serif font-semibold text-everglade text-3xl lg:text-5xl italic"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
            >
                {!! nl2br($howItWorks['section_title'] ?? 'HOW DOES IT WORK?') !!}
            </span>
        </h3>
    </div>

    <div class="mx-auto py-10 border-everglade border-b container">

        <div class="gap-10 lg:gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($howItWorks['steps'] ?? [] as $step)
                <div
                    class="flex flex-col items-center text-center"
                    x-intersect:enter.full="shown = true"
                    x-intersect:leave.full="shown = false"
                    x-data="{ shown: false }"
                >
                    {{-- Kembalikan ke p-4 seperti HTML awal --}}
                    <div class="flex flex-col justify-center items-center bg-everglade mb-4 p-4 rounded-full w-40 aspect-square">
                        <picture>
                            @if(!empty($step['icon_webp']))
                                <source
                                    srcset="{{ $step['icon_webp'] }}"
                                    type="image/webp"
                                >
                            @endif
                            {{-- Kembalikan ke object-cover seperti HTML awal --}}
                            <img
                                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                                class="w-full h-full object-cover motion-delay-200"
                                src="{{ $step['icon'] }}"
                                alt="{{ strip_tags($step['title']) }}"
                            >
                        </picture>
                    </div>

                    <div
                        :class="shown ? 'animate-up-in' : 'animate-up-out'"
                        class="motion-delay-300"
                    >
                        <h3 class="mb-2 font-bold text-everglade text-2xl uppercase tracking-wide">
                            {!! nl2br(($step['title'])) !!}
                        </h3>

                        <p class="max-w-[180px] text-everglade text-base leading-relaxed">
                            {!! $step['description'] !!}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</section>