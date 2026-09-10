<?php

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Illuminate\Support\Facades\App;

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

if (! function_exists('trans_field')) {

    function trans_field(mixed $value, ?string $field = null, string $fallbackLocale = 'en'): ?string
    {
        $currentLocale = App::getLocale();

        if (is_object($value) && $field) {
            $value = $value->{$field} ?? null;
        }

        if (is_null($value)) {
            return null;
        }

        if (is_string($value) && (str_starts_with($value, '{') || str_starts_with($value, '['))) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $value = $decoded;
            }
        }

        if (is_array($value)) {
            return $value[$currentLocale] 
                ?? $value[$fallbackLocale] 
                ?? reset($value) 
                ?: null;
        }

        return (string) $value;
    }
}
