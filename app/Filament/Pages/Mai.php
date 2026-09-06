<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Mai extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationLabel = 'MAI';

    protected static ?string $title = 'MAI — Monarchi AI';

    protected static ?string $slug = 'mai';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.mai';

    /**
     * Suppress default Filament header to let custom Gemini / Grok top bar shine.
     */
    public function getHeading(): string
    {
        return '';
    }

    protected function getViewData(): array
    {
        $user = auth()->user();
        $name = $user?->name ?? 'Administrator';
        $firstName = explode(' ', $name)[0];
        $initials = strtoupper(substr($name, 0, 2));
        $geminiModel = config('services.gemini.model', 'gemini-3.6-flash');
        $hasKey = ! empty(config('services.gemini.key'));

        return [
            'adminName' => $name,
            'adminFirstName' => $firstName,
            'adminInitials' => $initials,
            'geminiModel' => $geminiModel,
            'hasApiKey' => $hasKey,
        ];
    }
}
