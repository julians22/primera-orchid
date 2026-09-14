@php
    $isId = app()->getLocale() === 'id';
    $qTrim = trim($query);
    $qLength = mb_strlen($qTrim);
@endphp

<section class="my-8">
    <h2 class="text-2xl font-bold mb-6 text-everglade uppercase">
        @if ($qLength >= 4)
            {{ $isId ? 'Hasil Koleksi untuk "' . $query . '"' : 'Collection Results for "' . $query . '"' }}
        @elseif ($qLength > 0)
            {{ $isId ? 'Pencarian Koleksi' : 'Collection Search' }}
        @else
            {{ $isId ? 'Koleksi Kami' : 'Our Collections' }}
        @endif
    </h2>

    @if ($collections->isEmpty())
        <div class="p-8 text-center bg-gray-50 rounded-xl border border-dashed border-gray-300">
            <p class="text-gray-500 font-medium">
                @if ($qLength > 0 && $qLength < 5)
                    {{ $isId ? 'Ketik minimal 5 huruf untuk mencari koleksi.' : 'Please type at least 5 characters to search collections.' }}
                @elseif ($qLength >= 5)
                    {{ $isId ? 'Koleksi dengan kata kunci "' . $query . '" tidak ditemukan.' : 'No collections found for "' . $query . '".' }}
                @else
                    {{ $isId ? 'Data koleksi tidak tersedia.' : 'No collections available.' }}
                @endif
            </p>
        </div>
    @else
        @foreach ($collections as $collection)
            <div class="mb-14 border-b border-everglade/10 pb-10 last:border-b-0">
                
                <div class="flex justify-between items-end gap-x-10 mb-6">
                    <div>
                        <h3 class="font-serif font-semibold text-everglade text-3xl md:text-4xl italic">
                            {{ trans_field($collection, 'name') }}
                        </h3>
                        @if (trans_field($collection, 'short_description'))
                            <p class="text-everglade/80 text-sm md:text-base mt-1">
                                {{ trans_field($collection, 'short_description') }}
                            </p>
                        @endif
                    </div>

                    <a href="{{ route('collection.show', trans_field($collection, 'slug') ?? $collection->id) }}" 
                       class="text-everglade font-semibold text-sm hover:underline whitespace-nowrap">
                        {{ $isId ? 'Lihat Semua' : 'View All' }} &rarr;
                    </a>
                </div>

                @if ($collection->products->isEmpty())
                    <p class="text-gray-400 italic text-sm">
                        {{ $isId ? 'Tidak ada produk dalam koleksi ini.' : 'No products in this collection.' }}
                    </p>
                @else
                    <div class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        @foreach ($collection->products as $product)
                            @php
                                $productImage = method_exists($product, 'getFirstMediaUrl') && $product->getFirstMediaUrl('featured_image')
                                    ? $product->getFirstMediaUrl('featured_image')
                                    : asset('img/product-3.jpg');
                            @endphp

                            <x-product-card
                                :image="$productImage"
                                :name="trans_field($product, 'name')"
                                :href="route('product.show', trans_field($product, 'slug') ?? $product->id)"
                            />
                        @endforeach
                    </div>
                @endif

            </div>
        @endforeach
    @endif
</section>