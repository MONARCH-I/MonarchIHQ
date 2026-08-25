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
}
