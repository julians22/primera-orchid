<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class SearchArticles extends Component
{
    #[Reactive]
    public $query = '';

    public function render()
    {
        $articles = collect();
        $q = trim($this->query);

        if ($q === '') {
            $articles = Article::with(['categories', 'media'])
                ->latest()
                ->take(3)
                ->get();
        } elseif (mb_strlen($q) >= 5) {
            $articles = Article::with(['categories', 'media'])
                ->where(function ($queryBuilder) use ($q) {
                    $queryBuilder->where('title', 'like', "%{$q}%")
                        ->orWhere('short_description', 'like', "%{$q}%")
                        ->orWhere('body_content', 'like', "%{$q}%")
                        ->orWhere('slug', 'like', "%{$q}%");
                })
                ->latest()
                ->get();
        }

        return view('livewire.search-articles', compact('articles'));
    }
}
