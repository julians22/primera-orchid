<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;

class SearchPage extends Component
{
    #[Url(as: 'query', keep: true)]
    public $query = '';

    public $search = '';

    public function mount()
    {
        $this->query = request()->query('query', '');
        $this->search = $this->query;
    }

    public function updateSearch()
    {
        $this->query = trim($this->search);
    }

    public function render()
    {
        return view('livewire.search-page')
            ->extends('layouts.app')
            ->section('content');
    }
}