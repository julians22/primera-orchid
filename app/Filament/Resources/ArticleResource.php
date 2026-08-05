<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages\CreateArticle;
use App\Filament\Resources\ArticleResource\Pages\EditArticle;
use App\Filament\Resources\ArticleResource\Pages\ListArticles;
use App\Models\Article;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class ArticleResource extends Resource
{
    use Translatable;

    protected static ?string $model = Article::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected static string | \UnitEnum | null $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Articles';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Article')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug((string) $state))),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Auto generated from title, but still editable.'),

                        Textarea::make('short_description')
                            ->rows(3)
                            ->maxLength(65535),

                        RichEditor::make('body_content')
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('articles'),
                    ])
                    ->columns(2),

                Section::make('Relations')
                    ->schema([
                        Select::make('categories')
                            ->relationship('categories', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),

                        Select::make('tags')
                            ->relationship('tags', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),

                Section::make('Media')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('featured_image')
                            ->collection('featured_image')
                            ->image()
                            ->required(),

                        SpatieMediaLibraryFileUpload::make('thumbnail_image')
                            ->collection('thumbnail_image')
                            ->image(),
                    ])
                    ->columns(2),

                Section::make('Meta')
                    ->schema([
                        TextInput::make('meta_title')
                            ->maxLength(255),

                        Textarea::make('meta_description')
                            ->rows(3),

                        TextInput::make('meta_keyword')
                            ->maxLength(255),

                        SpatieMediaLibraryFileUpload::make('meta_og_image')
                            ->collection('meta_og_image')
                            ->image(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Featured')
                    ->getStateUsing(fn (Article $record): ?string => $record->getFirstMediaUrl('featured_image') ?: null),

                TextColumn::make('title')
                    ->searchable(['title->en', 'title->id'])
                    ->sortable(),

                TextColumn::make('slug')
                    ->searchable(['slug->en', 'slug->id'])
                    ->limit(40),

                TextColumn::make('categories_count')
                    ->counts('categories')
                    ->label('Categories'),

                TextColumn::make('tags_count')
                    ->counts('tags')
                    ->label('Tags'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArticles::route('/'),
            'create' => CreateArticle::route('/create'),
            'edit' => EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getTranslatableLocales(): array
    {
        return ['en', 'id'];
    }
}
