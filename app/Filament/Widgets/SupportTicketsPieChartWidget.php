<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class SupportTicketsPieChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Support Tickets by Product Category';

    protected static ?int $sort = 9;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        // Swap with real support ticket query e.g.:
        // SupportTicket::selectRaw('product_category, count(*) as total')->groupBy('product_category')->pluck('total', 'product_category')

        return [
            'datasets' => [
                [
                    'data'            => [42, 28, 18, 12],
                    'backgroundColor' => [
                        'rgba(239,68,68,0.8)',   // Hardware
                        'rgba(0,113,227,0.8)',   // SaaS
                        'rgba(245,158,11,0.8)',  // Custom Dev
                        'rgba(107,114,128,0.6)', // Other
                    ],
                    'borderWidth'     => 2,
                    'borderColor'     => '#fff',
                    'hoverOffset'     => 6,
                ],
            ],
            'labels' => ['Hardware', 'SaaS', 'Custom Dev', 'Other'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => ['position' => 'bottom'],
            ],
            'cutout' => '65%',
        ];
    }
}
