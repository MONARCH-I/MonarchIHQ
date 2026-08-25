<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class SaasChurnRateChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Monthly Churn Rate (Last 12 Months)';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        // Swap with real query e.g.:
        // SELECT DATE_FORMAT(cancelled_at, '%Y-%m') as month, COUNT(*) / (SELECT COUNT(*) FROM subscriptions WHERE ...) * 100 as rate
        // FROM subscriptions WHERE cancelled_at >= now() - interval 12 month GROUP BY month
        $months = ['Sep','Oct','Nov','Dec','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug'];
        $rates  = [4.2, 3.8, 4.5, 5.1, 3.9, 3.2, 2.8, 3.0, 2.5, 2.2, 2.0, 1.9];

        return [
            'datasets' => [
                [
                    'label'           => 'Churn Rate (%)',
                    'data'            => $rates,
                    'borderColor'     => '#f59e0b',
                    'backgroundColor' => 'rgba(245,158,11,0.08)',
                    'tension'         => 0.4,
                    'fill'            => true,
                    'pointBackgroundColor' => '#f59e0b',
                    'pointRadius'     => 4,
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'max'         => 10,
                    'ticks'       => ['callback' => 'function(v){return v+"%"}'],
                ],
            ],
            'plugins' => ['legend' => ['display' => false]],
        ];
    }
}
