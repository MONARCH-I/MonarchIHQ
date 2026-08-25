<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class SaasCacVsLtvChartWidget extends ChartWidget
{
    protected static ?string $heading = 'CAC vs. LTV by Acquisition Channel';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        // Swap with real CRM / ad-spend queries
        // CAC = total marketing spend / new customers acquired
        // LTV = avg monthly revenue per customer * avg subscription lifetime (months)
        $channels = ['Google Ads', 'Social Media', 'Referral', 'Organic SEO', 'Direct'];

        return [
            'datasets' => [
                [
                    'label'           => 'CAC (₵)',
                    'data'            => [420, 310, 180, 95, 60],
                    'backgroundColor' => 'rgba(239,68,68,0.75)',
                    'borderRadius'    => 6,
                ],
                [
                    'label'           => 'LTV (₵)',
                    'data'            => [2800, 2200, 3500, 4100, 3800],
                    'backgroundColor' => 'rgba(34,197,94,0.75)',
                    'borderRadius'    => 6,
                ],
            ],
            'labels' => $channels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks'       => ['callback' => 'function(v){return "₵"+v}'],
                ],
            ],
            'plugins' => ['legend' => ['position' => 'bottom']],
        ];
    }
}
