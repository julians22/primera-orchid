<?php

namespace App\Filament\Resources\ServiceResource\RelationManagers;

use App\Models\ServiceItem;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Service Items';

    public static function getModelLabel(): string
    {
        return 'Service Item';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Service Items';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Item Title')
                    ->required()
                    ->maxLength(255),

                TextInput::make('subtitle')
                    ->label('Item Subtitle')
                    ->maxLength(255),

                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0),

                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('image')
                    ->label('Item Image')
                    ->image(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->getStateUsing(fn (ServiceItem $record): ?string => $record->getFirstMediaUrl('image') ?: null)
                    ->circular(false),

                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('New Item')
                    ->modalHeading('Create Service Item')
                    ->modalSubmitActionLabel('Save item'),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Service Item')
                    ->modalSubmitActionLabel('Save changes'),
                DeleteAction::make(),
                Action::make('moveUp')
                    ->label('Move up')
                    ->icon('heroicon-o-arrow-up')
                    ->requiresConfirmation(false)
                    ->action(function (ServiceItem $record): void {
                        $previous = $record->service->items()
                            ->where('sort_order', '<', $record->sort_order)
                            ->orderByDesc('sort_order')
                            ->first();

                        if (! $previous) {
                            return;
                        }

                        $record->sort_order = $previous->sort_order;
                        $previous->sort_order = $record->getOriginal('sort_order');
                        $record->save();
                        $previous->save();
                    }),

                Action::make('moveDown')
                    ->label('Move down')
                    ->icon('heroicon-o-arrow-down')
                    ->requiresConfirmation(false)
                    ->action(function (ServiceItem $record): void {
                        $next = $record->service->items()
                            ->where('sort_order', '>', $record->sort_order)
                            ->orderBy('sort_order')
                            ->first();

                        if (! $next) {
                            return;
                        }

                        $record->sort_order = $next->sort_order;
                        $next->sort_order = $record->getOriginal('sort_order');
                        $record->save();
                        $next->save();
                    }),
            ])
            ->defaultSort('sort_order', 'asc');
    }
}
