<?php

namespace App\Filament\Pages;

use App\Models\PageSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TagsInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use UnitEnum;

class ManagePageSettings extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Page Settings';

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    protected string $view = 'filament.pages.manage-page-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = PageSetting::all();
        
        $formData = [];
        foreach ($settings as $setting) {
            $payload = $setting->payload ?? [];

            if ($setting->page_key === 'home' && $setting->section_key === 'hero' && isset($payload['slides'])) {
                $payload['slides'] = collect($payload['slides'])
                    ->map(fn ($slide) => [
                        'image_desktop'  => $this->normalizeFile($slide['image_desktop'] ?? null),
                        'image_mobile'   => $this->normalizeFile($slide['image_mobile'] ?? null),
                        'heading_en'     => $slide['heading_en'] ?? null,
                        'heading_id'     => $slide['heading_id'] ?? null,
                        'title_en'       => $slide['title_en'] ?? null,
                        'title_id'       => $slide['title_id'] ?? null,
                        'subtitle_en'    => $slide['subtitle_en'] ?? null,
                        'subtitle_id'    => $slide['subtitle_id'] ?? null,
                        'button_text_en' => $slide['button_text_en'] ?? null,
                        'button_text_id' => $slide['button_text_id'] ?? null,
                        'button_url'     => $slide['button_url'] ?? null,
                    ])
                    ->values()
                    ->toArray();
            }

            $formData[$setting->page_key][$setting->section_key] = $payload;
        }

        $this->form->fill($formData);
    }

    protected function normalizeFile($value): ?string
    {
        if (is_array($value)) {
            return collect($value)->first();
        }

        return is_string($value) ? $value : null;
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $pageKey => $sections) {
            if (is_array($sections)) {
                foreach ($sections as $sectionKey => $payload) {
                    if (! is_array($payload)) continue;

                    if ($pageKey === 'home' && $sectionKey === 'hero' && isset($payload['slides'])) {
                        $payload['slides'] = collect($payload['slides'])
                            ->map(fn ($slide) => [
                                'image_desktop'  => $this->normalizeFile($slide['image_desktop'] ?? null),
                                'image_mobile'   => $this->normalizeFile($slide['image_mobile'] ?? null),
                                'heading_en'     => $slide['heading_en'] ?? null,
                                'heading_id'     => $slide['heading_id'] ?? null,
                                'title_en'       => $slide['title_en'] ?? null,
                                'title_id'       => $slide['title_id'] ?? null,
                                'subtitle_en'    => $slide['subtitle_en'] ?? null,
                                'subtitle_id'    => $slide['subtitle_id'] ?? null,
                                'button_text_en' => $slide['button_text_en'] ?? null,
                                'button_text_id' => $slide['button_text_id'] ?? null,
                                'button_url'     => $slide['button_url'] ?? null,
                            ])
                            ->values()
                            ->toArray();
                    }

                    PageSetting::updateOrCreate(
                        [
                            'page_key' => $pageKey,
                            'section_key' => $sectionKey,
                        ],
                        [
                            'payload' => $payload ?? [],
                        ]
                    );
                }
            }
        }

        $this->mount();

        Notification::make()
            ->title('Settings Saved Successfully')
            ->success()
            ->send();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Pages')
                    ->tabs([
                    
                        Tab::make('Home Page')
                            ->schema([
                                Tabs::make('HomeSubtabs')
                                    ->tabs([                                        
                                        Tab::make('Meta & SEO')
                                            ->schema([
                                                Grid::make(2)->schema([
                                                    TextInput::make('home.seo_meta.meta_title_en')->label('Meta Title (EN)')->nullable(),
                                                    TextInput::make('home.seo_meta.meta_title_id')->label('Meta Title (ID)')->nullable(),
                                                ]),
                                                Grid::make(2)->schema([
                                                    Textarea::make('home.seo_meta.meta_description_en')->label('Meta Description (EN)')->rows(3)->nullable(),
                                                    Textarea::make('home.seo_meta.meta_description_id')->label('Meta Description (ID)')->rows(3)->nullable(),
                                                ]),
                                                // TagsInput::make('home.seo_meta.meta_keywords')
                                                //     ->label('Meta Keywords')
                                                //     ->placeholder('Tambahkan keyword...')
                                                //     ->splitKeys(['Enter', ','])
                                                //     ->nullable(),
                                            ]),

                                        Tab::make('Hero Banner')
                                            ->schema([
                                                Repeater::make('home.hero.slides')
                                                    ->label('Hero Slider Slides')
                                                    ->schema([
                                                        Grid::make(2)->schema([
                                                            FileUpload::make('image_desktop')
                                                                ->label('Desktop Image (1024px+)')
                                                                ->image()
                                                                ->directory('home/hero')
                                                                ->disk('public')
                                                                ->nullable(),
                                                            FileUpload::make('image_mobile')
                                                                ->label('Mobile Image')
                                                                ->image()
                                                                ->directory('home/hero')
                                                                ->disk('public')
                                                                ->nullable(),
                                                        ]),

                                                        Grid::make(2)->schema([
                                                            Textarea::make('heading_en')->label('Heading (EN)')->nullable(),
                                                            Textarea::make('heading_id')->label('Heading (ID)')->nullable(),
                                                        ]),

                                                        Grid::make(2)->schema([
                                                            TextInput::make('title_en')->label('Main Title (EN)')->nullable(),
                                                            TextInput::make('title_id')->label('Main Title (ID)')->nullable(),
                                                        ]),

                                                        Grid::make(2)->schema([
                                                            Textarea::make('subtitle_en')->label('Subtitle (EN)')->rows(2)->nullable(),
                                                            Textarea::make('subtitle_id')->label('Subtitle (ID)')->rows(2)->nullable(),
                                                        ]),

                                                        Grid::make(3)->schema([
                                                            TextInput::make('button_text_en')->label('Button Text (EN)')->nullable(),
                                                            TextInput::make('button_text_id')->label('Button Text (ID)')->nullable(),
                                                            TextInput::make('button_url')->label('Button Link URL')->nullable(),
                                                        ]),
                                                    ])
                                                    ->collapsible()
                                                    ->itemLabel(fn (array $state): ?string => $state['title_en'] ?? $state['title_id'] ?? 'Slide Banner')
                                                    ->defaultItems(1),
                                            ]),

                                        Tab::make('Testimonials')
                                            ->schema([
                                                TextInput::make('home.testimonials.section_title')->label('Section Title')->nullable(),
                                                Repeater::make('home.testimonials.items')
                                                    ->label('Testimonial List')
                                                    ->schema([
                                                        TextInput::make('client_name')->label('Client Name')->nullable(),
                                                        TextInput::make('role')->label('Role / Company')->nullable(),
                                                        Textarea::make('review')->label('Review')->rows(3)->nullable(),
                                                    ])
                                                    ->columns(2)
                                                    ->nullable(),
                                            ]),

                                    ]),
                            ]),

                        // About Page
                        Tab::make('About Page')
                            ->schema([
                                Tabs::make('AboutSubtabs')
                                    ->tabs([
                                        // SUBTAB: META / SEO
                                        Tab::make('Meta & SEO')
                                            ->schema([
                                                Grid::make(2)->schema([
                                                    TextInput::make('about.seo_meta.meta_title_en')->label('Meta Title (EN)')->nullable(),
                                                    TextInput::make('about.seo_meta.meta_title_id')->label('Meta Title (ID)')->nullable(),
                                                ]),
                                                Grid::make(2)->schema([
                                                    Textarea::make('about.seo_meta.meta_description_en')->label('Meta Description (EN)')->rows(3)->nullable(),
                                                    Textarea::make('about.seo_meta.meta_description_id')->label('Meta Description (ID)')->rows(3)->nullable(),
                                                ]),
                                            ]),

                                       

                                    ]),
                            ]),

                        Tab::make('Collections Page')
                            ->schema([
                                Tabs::make('CollectionsSubtabs')
                                    ->tabs([
                                        Tab::make('Meta & SEO')
                                            ->schema([
                                                Grid::make(2)->schema([
                                                    TextInput::make('collections.seo_meta.meta_title_en')->label('Meta Title (EN)')->nullable(),
                                                    TextInput::make('collections.seo_meta.meta_title_id')->label('Meta Title (ID)')->nullable(),
                                                ]),
                                                Grid::make(2)->schema([
                                                    Textarea::make('collections.seo_meta.meta_description_en')->label('Meta Description (EN)')->rows(3)->nullable(),
                                                    Textarea::make('collections.seo_meta.meta_description_id')->label('Meta Description (ID)')->rows(3)->nullable(),
                                                ]),
                                            ]),
                                    ]),
                            ]),
                        
                        Tab::make('Articles Page')
                            ->schema([
                                Tabs::make('ArticlesSubtabs')
                                    ->tabs([
                                        Tab::make('Meta & SEO')
                                            ->schema([
                                                Grid::make(2)->schema([
                                                    TextInput::make('articles.seo_meta.meta_title_en')->label('Meta Title (EN)')->nullable(),
                                                    TextInput::make('articles.seo_meta.meta_title_id')->label('Meta Title (ID)')->nullable(),
                                                ]),
                                                Grid::make(2)->schema([
                                                    Textarea::make('articles.seo_meta.meta_description_en')->label('Meta Description (EN)')->rows(3)->nullable(),
                                                    Textarea::make('articles.seo_meta.meta_description_id')->label('Meta Description (ID)')->rows(3)->nullable(),
                                                ]),
                                            ]),
                                    ]),
                            ]),

                        Tab::make('Subscription Page')
                            ->schema([
                                Tabs::make('SubscriptionSubtabs')
                                    ->tabs([
                                        Tab::make('Meta & SEO')
                                            ->schema([
                                                Grid::make(2)->schema([
                                                    TextInput::make('subscription.seo_meta.meta_title_en')->label('Meta Title (EN)')->nullable(),
                                                    TextInput::make('subscription.seo_meta.meta_title_id')->label('Meta Title (ID)')->nullable(),
                                                ]),
                                                Grid::make(2)->schema([
                                                    Textarea::make('subscription.seo_meta.meta_description_en')->label('Meta Description (EN)')->rows(3)->nullable(),
                                                    Textarea::make('subscription.seo_meta.meta_description_id')->label('Meta Description (ID)')->rows(3)->nullable(),
                                                ]),
                                            ]),
                                    ]),
                            ]),
                        
                        Tab::make('Contact Page')
                            ->schema([
                                Tabs::make('ContactSubtabs')
                                    ->tabs([
                                        Tab::make('Meta & SEO')
                                            ->schema([
                                                Grid::make(2)->schema([
                                                    TextInput::make('contact.seo_meta.meta_title_en')->label('Meta Title (EN)')->nullable(),
                                                    TextInput::make('contact.seo_meta.meta_title_id')->label('Meta Title (ID)')->nullable(),
                                                ]),
                                                Grid::make(2)->schema([
                                                    Textarea::make('contact.seo_meta.meta_description_en')->label('Meta Description (EN)')->rows(3)->nullable(),
                                                    Textarea::make('contact.seo_meta.meta_description_id')->label('Meta Description (ID)')->rows(3)->nullable(),
                                                ]),
                                            ]),
                                    ]),
                            ]),

                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }
}