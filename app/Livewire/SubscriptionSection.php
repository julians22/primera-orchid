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
            $services = Service::with([
                'items' => function ($itemQuery) {
                    $itemQuery->take(3);
                },
                'items.media',
            ])->get();
        } elseif (mb_strlen($q) >= 5) {
            $services = Service::with(['items' => function ($itemQuery) use ($q) {
                $itemQuery->where('title', 'like', "%{$q}%")
                          ->orWhere('subtitle', 'like', "%{$q}%");
            }, 'items.media'])
            ->where(function ($queryBuilder) use ($q) {
                $queryBuilder->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
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