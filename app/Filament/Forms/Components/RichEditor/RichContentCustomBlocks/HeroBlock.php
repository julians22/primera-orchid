<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class HeroBlock extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'hero';
    }

    public static function getLabel(): string
    {
        return 'Hero Configuration';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Configure the hero section.')
            ->schema([
                TextInput::make('tagline')
                    ->label('Tagline')
                    ->required()
                    ->maxLength(255),
                Textarea::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('subtitle')
                    ->label('Subtitle')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function getPreviewLabel(array $config): string
    {
        return "Hero Section: {$config['title']}";
    }

    public static function toPreviewHtml(array $config): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.hero.preview', [
            'tagline' => $config['tagline'] ?? null,
            'title' => $config['title'] ?? null,
            'subtitle' => $config['subtitle'] ?? null,
        ])->render();
    }

    public static function toHtml(array $config, array $data): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.hero.index', [
            'tagline' => $config['tagline'] ?? null,
            'title' => $config['title'] ?? null,
            'subtitle' => $config['subtitle'] ?? null,
        ])->render();
    }
}
