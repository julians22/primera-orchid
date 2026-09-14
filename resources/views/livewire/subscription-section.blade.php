@php
    $isId = app()->getLocale() === 'id';
    $qTrim = trim($query);
    $qLength = mb_strlen($qTrim);
@endphp

<section class="my-8 space-y-16 mx-auto px-6 py-12 container">
    {{-- Header Dynamic Title --}}
    <h2 class="text-2xl font-bold mb-6 text-everglade uppercase">
        @if ($qLength >= 5)
            {{ $isId ? 'Hasil Layanan untuk "' . $query . '"' : 'Service Results for "' . $query . '"' }}
        @elseif ($qLength > 0)
            {{ $isId ? 'Pencarian Layanan' : 'Service Search' }}
        @else
            {{ $isId ? 'Layanan Kami' : 'Our Services' }}
        @endif
    </h2>

    @if ($services->isEmpty())
        {{-- Empty State Box --}}
        <div class="p-8 text-center bg-gray-50 rounded-xl border border-dashed border-gray-300">
            <p class="text-gray-500 font-medium">
                @if ($qLength > 0 && $qLength < 5)
                    {{ $isId ? 'Ketik minimal 5 huruf untuk mencari layanan.' : 'Please type at least 5 characters to search services.' }}
                @elseif ($qLength >= 5)
                    {{ $isId ? 'Layanan dengan kata kunci "' . $query . '" tidak ditemukan.' : 'No services found for "' . $query . '".' }}
                @else
                    {{ $isId ? 'Data layanan tidak tersedia.' : 'No services available.' }}
                @endif
            </p>
        </div>
    @else
        {{-- Loop Data Services --}}
        @foreach ($services as $service)
            <div @if(!$loop->last) class="pb-4 lg:pb-12 border-everglade border-b" @endif>

                <div class="flex sm:flex-row flex-col sm:justify-between sm:items-start gap-3 mb-6">
                    <div>
                        <p class="text-teal-900 text-2xl tracking-[0.15em]">
                            {!! __('services.subscription') !!}
                        </p>

                        <h2 class="-mt-1 font-serif font-semibold text-teal-900 text-5xl italic">
                            {{ trans_field($service, 'title') ?? trans_field($service, 'name') }}
                        </h2>
                    </div>

                    <p class="max-w-2xl font-semibold text-teal-900 sm:text-right leading-relaxed">
                        {{ 
                            trans_field($service, 'description') 
                            ?? data_get($service->description, 'en') 
                            ?? trans_field($service, 'short_description') 
                            ?? data_get($service->short_description, 'en') 
                        }}
                    </p>
                </div>

                {{-- Loop Items per Service --}}
                @if ($service->items->isEmpty())
                    <p class="text-gray-400 italic text-sm">
                        {{ $isId ? 'Tidak ada item dalam layanan ini.' : 'No items in this service.' }}
                    </p>
                @else
                    <div class="gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($service->items as $item)
                            @php
                                $serviceTitle = trans_field($service, 'title') ?? trans_field($service, 'name');
                                $itemTitle = trans_field($item, 'title') ?? trans_field($item, 'name');

                                $waServiceMessage = str_replace(
                                    [':service', ':item'],
                                    [$serviceTitle, $itemTitle],
                                    __('services.service_item.whatsapp_message')
                                );

                                $itemImage = method_exists($item, 'getFirstMediaUrl') && $item->getFirstMediaUrl('image')
                                    ? $item->getFirstMediaUrl('image')
                                    : asset('img/product-3.jpg');
                            @endphp

                            <a
                                href="{{ whatsapp_link('6282218181660', $waServiceMessage) }}"
                                class="relative flex flex-col bg-everglade shadow-sm rounded-lg overflow-hidden"
                                target="_blank"
                            >
                                <div class="flex-shrink-0 w-full aspect-[12/8] overflow-hidden">
                                    <img
                                        src="{{ $itemImage }}"
                                        alt="{{ $itemTitle }}"
                                        class="rounded-lg w-full h-full object-cover"
                                    >
                                </div>

                                <div class="flex flex-col justify-center bg-everglade py-3 h-full text-white text-center">
                                    <p class="font-bold text-lg">
                                        {{ $itemTitle }}
                                    </p>

                                    @if ($item->subtitle || trans_field($item, 'subtitle'))
                                        <p class="font-medium text-sm">
                                            {{ trans_field($item, 'subtitle') ?? $item->subtitle }}
                                        </p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

            </div>
        @endforeach
    @endif
</section>