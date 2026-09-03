<?php

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock;
use Filament\Forms\Components\RichEditor\RichContentRenderer;

if (!function_exists('collection_hero_renderer')) {
    function collection_hero_renderer(string $bodyContent): string
    {
        // Use regex to find the hero block in the body content
        return RichContentRenderer::make($bodyContent)
            ->customBlocks([
                HeroBlock::class,
            ])
            ->toHtml();
    }
}

if (!function_exists('whatsapp_link')) {
    function whatsapp_link(string $phoneNumber, ?string $message = null): string
    {
        $encodedMessage = $message ? urlencode($message) : '';
        return "https://wa.me/{$phoneNumber}" . ($encodedMessage ? "?text={$encodedMessage}" : '');
    }
}
