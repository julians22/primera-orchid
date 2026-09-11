<section class="bg-white py-8 lg:py-20 min-h-36">

    <!-- Section Title Desktop -->
    <div x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }">
        <h3 class="hidden lg:flex flex-col items-center gap-4">
            <span class="text-2xl"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                >{{ __('components.ourCustomers.line1') }}</span>
            <span class="font-serif font-semibold text-everglade text-5xl italic"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                >{{ __('components.ourCustomers.line2') }}</span>
        </h3>
    </div>

    <!-- Section Title Mobile -->
    <div x-intersect:enter="shown = true" x-intersect:leave="shown = false" x-data="{ shown: false }">
        <h3 class="lg:hidden flex flex-col items-center gap-4 text-center">
            <span class="text-2xl"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                >{{ __('components.ourCustomers.line1') }}</span>
            <span class="font-serif font-semibold text-everglade text-5xl italic"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                >{{ __('components.ourCustomers.line2') }}</span>
        </h3>
    </div>

    <div class="mx-auto pt-10 lg:pt-20 container">
        <div class="flex lg:flex-row flex-col justify-center gap-4">

            @foreach($testimonials as $item)
                @php
                    // 1. Handle Avatar
                    $avatarUrl = is_array($item) 
                        ? $item['avatar'] 
                        : ($item->avatar ? asset('storage/' . $item->avatar) : asset('img/customer-1.png'));

                    // 2. Handle Name & Location
                    $name = is_array($item) ? $item['name'] : $item->name;
                    $location = is_array($item) ? $item['location'] : $item->location;

                    // 3. Handle Content Multilingual
                    if (is_array($item)) {
                        // Jika data Dummy (Array biasa)
                        $locale = app()->getLocale();
                        $text = $item['content'][$locale] ?? ($item['content']['en'] ?? ($item['content']['id'] ?? ''));
                    } else {
                        // Jika Model Eloquent (Spatie Translatable)
                        $text = $item->content;

                        // Fallback jika bahasa aktif di DB kosong
                        if (empty($text)) {
                            $enText = $item->getTranslation('content', 'en', false);
                            $idText = $item->getTranslation('content', 'id', false);
                            $text = !empty($enText) ? $enText : $idText;
                        }
                    }
                @endphp

                <div class="relative flex lg:flex-row flex-col bg-soft-linen-100 px-4 pt-4 lg:pt-16 pb-4 rounded-2xl max-w-2xl">
                    <div class="lg:-top-16 lg:left-1/2 lg:absolute lg:inset-x-0 mx-auto lg:mx-0 rounded-full w-32 h-32 overflow-hidden lg:-translate-x-1/2">
                        <img src="{{ $avatarUrl }}" alt="{{ $name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-bold text-everglade text-xl">{{ $name }}</p>
                        
                        @if($location)
                            <p class="mb-6 text-everglade text-sm"><i>{{ $location }}</i></p>
                        @endif
                        
                        <p class="text-everglade text-lg">"{{ $text }}"</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

</section>