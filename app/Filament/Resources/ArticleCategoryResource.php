<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleCategoryResource\Pages\CreateArticleCategory;
use App\Filament\Resources\ArticleCategoryResource\Pages\EditArticleCategory;
use App\Filament\Resources\ArticleCategoryResource\Pages\ListArticleCategories;
use App\Models\ArticleCategory;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class ArticleCategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = ArticleCategory::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-group';

    protected static string | \UnitEnum | null $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Article Categories';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug((string) $state))),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(['title->en', 'title->id'])
                    ->sortable(),

                TextColumn::make('slug')
                    ->searchable(['slug->en', 'slug->id'])
                    ->sortable(),

                TextColumn::make('articles_count')
                    ->counts('articles')
                    ->label('Articles'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArticleCategories::route('/'),
            'create' => CreateArticleCategory::route('/create'),
            'edit' => EditArticleCategory::route('/{record}/edit'),
        ];
    }

    public static function getTranslatableLocales(): array
    {
        return ['en', 'id'];
    }
}
