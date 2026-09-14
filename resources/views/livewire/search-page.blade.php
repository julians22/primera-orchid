@php
    $isId = app()->getLocale() === 'id';
@endphp

<div class="space-y-12 min-h-[50vh]">
    
    <section 
        class="flex items-center bg-cover bg-no-repeat bg-center h-auto md:h-[65vh]" 
        style="background-image: url('{{ asset('img/bg-pattern.jpg') }}')"
    >
        <div class="flex flex-col items-center gap-6 mx-auto py-20 px-4 w-full max-w-3xl text-center">
            
            <h1 class="font-serif font-semibold text-everglade text-4xl lg:text-6xl italic uppercase">
                {{ $isId ? 'Cari di Primera Orchid' : 'Search Primera Orchid' }}
            </h1>

            <p class="text-everglade text-lg lg:text-xl tracking-widest max-w-xl">
                {{ $isId ? 'TEMUKAN KOLEKSI, PRODUK, DAN ARTIKEL TERBAIK KAMI' : 'FIND OUR BEST COLLECTIONS, PRODUCTS, AND ARTICLES' }}
            </p>

            <div class="w-full max-w-xl relative mt-2">
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="query"
                    placeholder="{{ $isId ? 'Ketik nama artikel, produk, atau koleksi...' : 'Type article, product, or collection name...' }}"
                    class="w-full px-6 py-4 pr-14 bg-white/90 backdrop-blur-sm border-2 border-everglade text-everglade rounded-full focus:outline-none focus:ring-2 focus:ring-everglade text-base lg:text-lg shadow-md placeholder:text-everglade/60"
                >
                <div class="absolute right-5 top-1/2 -translate-y-1/2 text-everglade pointer-events-none">
                    <svg wire:loading.remove wire:target="query" class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path>
                    </svg>

                    <svg wire:loading wire:target="query" class="size-6 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4z"></path>
                    </svg>
                </div>
            </div>

        </div>
    </section>

    <div class="container mx-auto px-4 space-y-12 pb-12">
        
        @livewire('search-articles', ['query' => $query], key('articles-'.md5($query)))

        @livewire('search-collections', ['query' => $query], key('collections-'.md5($query)))

        @livewire('subscription-section', ['query' => $query], key('services-'.md5($query)))

    </div>

</div>