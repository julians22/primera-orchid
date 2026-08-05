<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StickyArticleResource\Pages\CreateStickyArticle;
use App\Filament\Resources\StickyArticleResource\Pages\EditStickyArticle;
use App\Filament\Resources\StickyArticleResource\Pages\ListStickyArticles;
use App\Models\StickyArticle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StickyArticleResource extends Resource
{
    protected static ?string $model = StickyArticle::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-bookmark-square';

    protected static string | \UnitEnum | null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Sticky Articles';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Sticky Article')
                    ->schema([
                        Select::make('article_id')
                            ->label('Article')
                            ->relationship('article', 'title')
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('order_number')
                            ->numeric()
                            ->required()
                            ->default(1)
                            ->minValue(1),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('article.title')
                    ->label('Article')
                    ->sortable(),

                TextColumn::make('order_number')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('order_number');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStickyArticles::route('/'),
            'create' => CreateStickyArticle::route('/create'),
            'edit' => EditStickyArticle::route('/{record}/edit'),
        ];
    }
}
