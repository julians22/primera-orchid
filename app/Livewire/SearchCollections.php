<?php

namespace App\Livewire;

use App\Models\Collection;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class SearchCollections extends Component
{
    #[Reactive]
    public $query = '';

    public function render()
    {
        $collections = collect();
        $q = trim($this->query);

        if ($q !== '') {
            // SAAT SEARCHING: Tampilkan SEMUA produk yang cocok (tanpa dibatasi 3)
            $collections = Collection::with(['products', 'media'])
                ->where(function ($collectionQuery) use ($q) {
                    $collectionQuery->where('name', 'like', "%{$q}%")
                        ->orWhere('short_description', 'like', "%{$q}%")
                        ->orWhere('body_content', 'like', "%{$q}%")
                        ->orWhere('slug', 'like', "%{$q}%")
                        ->orWhereHas('products', function ($productQuery) use ($q) {
                            $productQuery->where('name', 'like', "%{$q}%")
                                ->orWhere('slug', 'like', "%{$q}%");
                        });
                })
                ->latest()
                ->get();
        } else {
            $collections = Collection::with([
                'products' => function ($productQuery) {
                    $productQuery->latest()->take(4);
                }, 
                'media'
            ])
            ->latest()
            ->take(3)
            ->get();
        }

        return view('livewire.search-collections', compact('collections'));
    }
}