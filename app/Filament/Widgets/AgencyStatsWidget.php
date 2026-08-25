<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AgencyStatsWidget extends BaseWidget
{
    protected static ?int $sort = 6;

    protected function getStats(): array
    {
        // ── Resource Utilization (billable dev hours / total dev capacity) ────
        // Swap with real time-tracking DB queries (e.g. Toggl, Clockify sync)
        $billableHours = 320;
        $totalCapacity = 480;
        $utilizationRate = round(($billableHours / $totalCapacity) * 100, 1);

        // ── Sales Pipeline Value (CRM "Proposal" + "Negotiation" deals) ───────
        // Swap with real CRM pipeline query
        $pipelineValue = 185000.00;

        // ── Average Time to Delivery (days: signed → deployed) ───────────────
        $avgDeliveryDays = 47;

        return [
            Stat::make('Resource Utilization Rate', $utilizationRate . '%')
                ->description($billableHours . 'h billable of ' . $totalCapacity . 'h capacity')
                ->descriptionIcon('heroicon-m-cpu-chip')
                ->color($utilizationRate >= 70 ? 'success' : ($utilizationRate >= 50 ? 'warning' : 'danger'))
                ->chart([55, 60, 65, 70, 68, 72, 75, 78, $utilizationRate]),

            Stat::make('Sales Pipeline Value', '₵' . number_format($pipelineValue, 2))
                ->description('Active proposals & negotiations')
                ->descriptionIcon('heroicon-m-funnel')
                ->color('info'),

            Stat::make('Avg. Time to Delivery', $avgDeliveryDays . ' days')
                ->description('From contract signing to deployment')
                ->descriptionIcon('heroicon-m-clock')
                ->color($avgDeliveryDays <= 45 ? 'success' : 'warning'),
        ];
    }
}
