<?php

namespace App\Filament\Resources\StickyArticleResource\Pages;

use App\Filament\Resources\StickyArticleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStickyArticle extends EditRecord
{
    protected static string $resource = StickyArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
