<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class SubscriptionSection extends Component
{
    #[Reactive]
    public $query = '';

    public function render()
    {
        $services = collect();
        $q = trim($this->query);

        if ($q === '') {
            // Tampilkan semua service beserta itemnya jika query kosong
            $services = Service::with([
                'items' => function ($itemQuery) {
                    $itemQuery->take(3);
                },
                'items.media',
            ])->get();
        } elseif (mb_strlen($q) >= 5) {
            // Filter Service induk DAN filter juga item-item di dalamnya
            $services = Service::with(['items' => function ($itemQuery) use ($q) {
                // Hanya load items yang cocok dengan pencarian
                $itemQuery->where('title', 'like', "%{$q}%")
                          ->orWhere('subtitle', 'like', "%{$q}%");
            }, 'items.media'])
            ->where(function ($queryBuilder) use ($q) {
                // Cek pencarian di level Service
                $queryBuilder->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    // ATAU jika Service tersebut punya item yang cocok
                    ->orWhereHas('items', function ($itemQuery) use ($q) {
                        $itemQuery->where('title', 'like', "%{$q}%")
                                  ->orWhere('subtitle', 'like', "%{$q}%");
                    });
            })
            ->get();
        }

        return view('livewire.subscription-section', compact('services'));
    }
}