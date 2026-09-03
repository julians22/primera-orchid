<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Filament\Resources\ProductResource\Pages\CreateProduct;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\ProductResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Spatie\LaravelFilamentMediaLibraryPlugin\Components\MediaLibraryFileUpload;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Products';

    protected static ?string $modelLabel = 'Product';

    protected static ?string $pluralModelLabel = 'Products';

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
                                    ->label('Body Content (English)')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('products'),
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
                                    ->label('Body Content (Indonesian)')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('products'),
                            ]),
                    ]),

                Section::make('Product Details')
                    ->schema([
                        Textarea::make('attributes')
                            ->label('Attributes / Additional Information')
                            ->rows(4)
                            ->helperText('e.g., Size: L, Material: Cotton, Color: Blue'),

                        Toggle::make('is_best_seller')
                            ->label('Featured Product')
                            ->helperText('Mark this as a best seller/featured product'),
                    ]),

                Section::make('Categories')
                    ->schema([
                        Select::make('collections')
                            ->label('Collections')
                            ->relationship('collections', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                    ]),

                Section::make('Related Products')
                    ->schema([
                        Select::make('related_products')
                            ->label('Related Products')
                            ->relationship('relatedProducts', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->helperText('Select other products to show as related'),
                    ]),

                Section::make('Media')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->collection('thumbnail')
                            ->label('Thumbnail Image')
                            ->image()
                            ->helperText('Recommended size: 500x500px'),

                        SpatieMediaLibraryFileUpload::make('collection_images')
                            ->collection('collection_images')
                            ->label('Product Gallery Images')
                            ->image()
                            ->multiple()
                            ->helperText('Upload multiple images for the product gallery'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Image')
                    ->getStateUsing(function (Product $record) {
                        $media = $record->getFirstMedia('thumbnail');
                        return $media ? $media->getUrl() : null;
                    }),

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable(['name->en', 'name->id'])
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(['slug->en', 'slug->id'])
                    ->limit(40),

                BooleanColumn::make('is_best_seller')
                    ->label('Featured')
                    ->sortable(),

                TextColumn::make('collections_count')
                    ->label('Collections')
                    ->counts('collections')
                    ->sortable(),

                TextColumn::make('collections.name')
                    ->label('Collections')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_best_seller')
                    ->label('Featured Products')
                    ->default(null)
                    ->placeholder('All')
                    ->trueLabel('Featured')
                    ->falseLabel('Not Featured'),
                // Collection Column Count Filter
                TernaryFilter::make('collections_count')
                    ->label('Collections')
                    ->default(null)
                    ->placeholder('All')
                    ->trueLabel('Has Collections')
                    ->falseLabel('No Collections')
                    ->queries(
                        true: fn ($query) => $query->has('collections'),
                        false: fn ($query) => $query->doesntHave('collections'),
                    ),
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
