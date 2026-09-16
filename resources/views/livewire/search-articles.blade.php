@php
    $isId = app()->getLocale() === 'id';
    $qTrim = trim($query);
    $qLength = mb_strlen($qTrim);
@endphp

<section class="my-8">
    <h2 class="text-2xl font-bold mb-6 text-everglade uppercase">
        @if ($qLength >= 4)
            {{ $isId ? 'Hasil Artikel untuk "' . $query . '"' : 'Article Results for "' . $query . '"' }}
        @elseif ($qLength > 0)
            {{ $isId ? 'Pencarian Artikel' : 'Article Search' }}
        @else
            {{ $isId ? 'Artikel Populer' : 'Popular Articles' }}
        @endif
    </h2>

    @if ($articles->isEmpty())
        <div class="p-8 text-center bg-gray-50 rounded-xl border border-dashed border-gray-300">
            <p class="text-gray-500 font-medium">
                @if ($qLength > 0 && $qLength < 5)
                    {{ $isId ? 'Ketik minimal 5 huruf untuk mencari artikel.' : 'Please type at least 5 characters to search articles.' }}
                @elseif ($qLength >= 5)
                    {{ $isId ? 'Artikel dengan kata kunci "' . $query . '" tidak ditemukan.' : 'No articles found for "' . $query . '".' }}
                @else
                    {{ $isId ? 'Data artikel tidak tersedia.' : 'No articles available.' }}
                @endif
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($articles as $article)
                @php
                    $imageUrl = $article->getFirstMediaUrl('featured_image') 
                             ?: $article->getFirstMediaUrl('thumbnail_image') 
                             ?: asset('img/article-1.png');

                    $categoryName = $article->categories->first() 
                        ? trans_field($article->categories->first(), 'name') 
                        : ($isId ? 'Umum' : 'General');

                    $descriptionText = trans_field($article, 'short_description') 
                                    ?? trans_field($article, 'body_content');
                @endphp

                <article 
                    x-data="{ shown: true }" 
                    x-intersect:enter.half="shown = true" 
                    x-intersect:leave.half="shown = false" 
                    class="flex flex-col gap-4 bg-[#f6f4ee] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-300"
                >
                    <div class="rounded-xl w-full aspect-[20/9] overflow-hidden bg-gray-100">
                        <img 
                            src="{{ $imageUrl }}" 
                            alt="{{ trans_field($article, 'title') }}" 
                            class="w-full h-full object-cover"
                        >
                    </div>

                    <div class="flex flex-col gap-2 px-8 py-4 flex-1 justify-between">
                        <div class="flex flex-col gap-2">
                            <p 
                                class="text-everglade text-sm delay-300"
                                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            >
                                {{ $categoryName }}
                            </p>

                            <h3 
                                class="font-semibold text-everglade text-2xl delay-500 line-clamp-2"
                                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            >
                                {{ trans_field($article, 'title') }}
                            </h3>

                            <div class="bg-everglade rounded-full w-full h-px my-1"></div>

                            <p 
                                class="text-everglade text-sm delay-500 line-clamp-3"
                                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                            >
                                {{ \Illuminate\Support\Str::limit(strip_tags((string) $descriptionText), 120, '...') }}
                            </p>
                        </div>

                        <div class="pt-4">
                            <a 
                                href="{{ route('article.show', ['article' => trans_field($article, 'slug') ?? $article->id]) }}"
                                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                                class="flex items-center space-x-2 px-4 py-1.5 border border-everglade rounded-full w-max text-everglade text-sm hover:bg-everglade hover:text-white transition"
                            >
                                <span class="font-semibold">{{ $isId ? 'Baca Selengkapnya' : 'Read More' }}</span>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>