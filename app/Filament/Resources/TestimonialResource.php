<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages\CreateTestimonial;
use App\Filament\Resources\TestimonialResource\Pages\EditTestimonial;
use App\Filament\Resources\TestimonialResource\Pages\ListTestimonials;
use App\Models\Testimonial;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    // CATATAN: Trait Translatable LaraZeus dihapus agar tidak menggunakan tab switcher

    protected static ?string $model = Testimonial::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static string | \UnitEnum | null $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Testimonials';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Testimonial Information')
                    ->schema([
                        FileUpload::make('avatar')
                            ->image()
                            ->avatar()
                            ->directory('testimonials')
                            ->columnSpanFull(),

                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('location')
                            ->maxLength(255)
                            ->placeholder('Surabaya, Indonesia'),

                        Fieldset::make('Content (Multi-Language)')
                            ->schema([
                                Textarea::make('content.en')
                                    ->label('Content (English)')
                                    ->rows(4)
                                    ->required(),

                                Textarea::make('content.id')
                                    ->label('Content (Bahasa Indonesia)')
                                    ->rows(4),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->circular(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('location')
                    ->searchable(),

                TextColumn::make('content.en')
                    ->label('Content (EN)')
                    ->limit(30),

                IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTestimonials::route('/'),
            'create' => CreateTestimonial::route('/create'),
            'edit' => EditTestimonial::route('/{record}/edit'),
        ];
    }
}
