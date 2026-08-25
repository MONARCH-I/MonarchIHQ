<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class EstoreSalesVolumeChartWidget extends ChartWidget
{
    protected static ?string $heading = 'E-Store Sales Volume — Last 30 Days';

    protected static ?int $sort = 8;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $days   = collect(range(29, 0))->map(fn ($d) => now()->subDays($d)->format('M j'));
        $totals = collect(range(29, 0))->map(function ($d) {
            return Order::whereDate('created_at', now()->subDays($d))
                        ->whereIn('status', ['processing', 'shipped', 'delivered'])
                        ->sum('total') ?: 0;
        });

        // Augment with mock data for demonstration while orders table is empty
        if ($totals->sum() == 0) {
            $mock = [800,1200,950,1800,2200,1500,2800,3100,2600,3400,2900,3800,
                     4200,3600,4800,5200,4100,5600,4900,6100,5500,6800,5900,7200,
                     6300,7800,6700,8400,7100,8900];
            $totals = collect($mock);
        }

        return [
            'datasets' => [
                [
                    'label'           => 'Daily Sales (₵)',
                    'data'            => $totals->values()->toArray(),
                    'borderColor'     => '#0071e3',
                    'backgroundColor' => 'rgba(0,113,227,0.08)',
                    'tension'         => 0.4,
                    'fill'            => true,
                    'pointRadius'     => 3,
                    'pointBackgroundColor' => '#0071e3',
                ],
            ],
            'labels' => $days->toArray(),
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
                    'ticks'       => ['callback' => 'function(v){return "₵"+v.toLocaleString()}'],
                ],
                'x' => ['grid' => ['display' => false]],
            ],
            'plugins' => ['legend' => ['display' => false]],
        ];
    }
}
