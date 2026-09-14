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
            $formData[$setting->page_key][$setting->section_key] = $setting->payload ?? [];
        }

        $this->form->fill($formData);
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
                                                Grid::make(2)->schema([
                                                    TextInput::make('home.hero.title_en')->label('Title (EN)')->nullable(),
                                                    TextInput::make('home.hero.title_id')->label('Title (ID)')->nullable(),
                                                ]),
                                                Grid::make(2)->schema([
                                                    Textarea::make('home.hero.subtitle_en')->label('Subtitle (EN)')->rows(3)->nullable(),
                                                    Textarea::make('home.hero.subtitle_id')->label('Subtitle (ID)')->rows(3)->nullable(),
                                                ]),
                                                Grid::make(2)->schema([
                                                    FileUpload::make('home.hero.image_1')->label('Banner Image 1')->image()->nullable(),
                                                    FileUpload::make('home.hero.image_2')->label('Banner Image 2')->image()->nullable(),
                                                ]),
                                                Grid::make(2)->schema([
                                                    TextInput::make('home.hero.button_text')->label('Button Text')->nullable(),
                                                    TextInput::make('home.hero.button_url')->label('Button URL')->nullable(),
                                                ]),
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

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $pageKey => $sections) {
            if (is_array($sections)) {
                foreach ($sections as $sectionKey => $payload) {
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

        Notification::make()
            ->title('Settings Saved Successfully')
            ->success()
            ->send();
    }
}