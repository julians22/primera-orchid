<?php

namespace App\Filament\Resources;

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\CollectionResource\Pages\ListCollections;
use App\Filament\Resources\CollectionResource\Pages\CreateCollection;
use App\Filament\Resources\CollectionResource\Pages\EditCollection;
use App\Models\Collection;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\CollectionResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class CollectionResource extends Resource
{
    protected static ?string $model = Collection::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Collections';

    protected static ?string $modelLabel = 'Collection';

    protected static ?string $pluralModelLabel = 'Collections';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Translations')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('name.en')
                                    ->label('Name (English)')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('slug.en')
                                    ->label('Slug (English)')
                                    ->maxLength(255)
                                    ->helperText('Auto-generated from name if left blank'),

                                Textarea::make('short_description.en')
                                    ->label('Short Description (English)')
                                    ->rows(3)
                                    ->maxLength(65535),

                                RichEditor::make('body_content.en')
                                    ->customBlocks([
                                        HeroBlock::class,
                                    ])
                                    ->label('Body Content (English)')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('collections'),
                            ]),

                        Tab::make('Indonesian')
                            ->schema([
                                TextInput::make('name.id')
                                    ->label('Name (Indonesian)')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('slug.id')
                                    ->label('Slug (Indonesian)')
                                    ->maxLength(255)
                                    ->helperText('Auto-generated from name if left blank'),

                                Textarea::make('short_description.id')
                                    ->label('Short Description (Indonesian)')
                                    ->rows(3)
                                    ->maxLength(65535),

                                RichEditor::make('body_content.id')
                                    ->customBlocks([
                                        HeroBlock::class,
                                    ])
                                    ->label('Body Content (Indonesian)')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('collections'),
                            ]),
                    ]),

                Section::make('Settings')
                    ->schema([
                        Select::make('body_content_pos')
                            ->label('Body Content Position')
                            ->options([
                                'left' => 'Left',
                                'right' => 'Right',
                            ])
                            ->default('left')
                            ->required(),
                    ]),

                Section::make('Media')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->collection('thumbnail')
                            ->label('Thumbnail Image')
                            ->image()
                            ->helperText('Recommended size: 400x300px'),

                        SpatieMediaLibraryFileUpload::make('hero_background')
                            ->collection('hero_background')
                            ->label('Hero Background Image')
                            ->image()
                            ->helperText('Recommended size: 1920x1080px'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable(['name->en', 'name->id'])
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(['slug->en', 'slug->id'])
                    ->limit(50),

                TextColumn::make('body_content_pos')
                    ->label('Content Position')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'left' => 'blue',
                        'right' => 'green',
                        default => 'gray',
                    }),

                TextColumn::make('products_count')
                    ->label('Products')
                    ->counts('products')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => ListCollections::route('/'),
            'create' => CreateCollection::route('/create'),
            'edit' => EditCollection::route('/{record}/edit'),
        ];
    }
}
