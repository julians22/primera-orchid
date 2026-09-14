<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages\CreateService;
use App\Filament\Resources\ServiceResource\Pages\EditService;
use App\Filament\Resources\ServiceResource\Pages\ListServices;
use App\Filament\Resources\ServiceResource\RelationManagers\ServiceItemsRelationManager;
use App\Models\Service;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $navigationLabel = 'Services';

    protected static ?string $modelLabel = 'Service';

    protected static ?string $pluralModelLabel = 'Services';

    protected static string | UnitEnum | null $navigationGroup = 'Content';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(), 
                Grid::make(2)
                    ->schema([
                        Textarea::make('description.en')
                            ->label('Description (EN)')
                            ->rows(4),

                        Textarea::make('description.id')
                            ->label('Description (ID)')
                            ->rows(4),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description.en')
                    ->label('Description (EN)')
                    ->getStateUsing(fn (Service $record) => $record->description['en'] ?? '-')
                    ->wrap()
                    ->limit(80)
                    ->searchable(query: function ($query, string $search) {
                        return $query->where('description', 'like', "%{$search}%");
                    }),

                TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            ServiceItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServices::route('/'),
            'create' => CreateService::route('/create'),
            'edit' => EditService::route('/{record}/edit'),
        ];
    }
}
