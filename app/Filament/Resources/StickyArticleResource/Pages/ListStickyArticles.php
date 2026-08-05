<?php

namespace App\Filament\Resources\StickyArticleResource\Pages;

use App\Filament\Resources\StickyArticleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStickyArticles extends ListRecords
{
    protected static string $resource = StickyArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
