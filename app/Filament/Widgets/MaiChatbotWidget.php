<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class MaiChatbotWidget extends Widget
{
    protected static ?int $sort = 11;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.mai-chatbot-widget';
}
