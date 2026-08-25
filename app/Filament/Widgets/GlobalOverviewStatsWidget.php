<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GlobalOverviewStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // ── MRR (mock: swap with real SaaS subscription query) ───────────────
        $mrr = 24750.00;
        $mrrTrend = [18500, 19200, 20100, 21000, 21800, 22500, 23100, 23800, 24200, 24500, 24750, 24750];

        // ── GMV — last 30 days orders ────────────────────────────────────────
        $gmv = Order::where('created_at', '>=', now()->subDays(30))
                    ->whereIn('status', ['processing', 'shipped', 'delivered'])
                    ->sum('total') ?: 18320.50;

        // ── Cash Runway (mock: revenue - expenses; months at burn rate) ───────
        $runway = 14; // months

        // ── Server uptime (mock: ping your health endpoint or pull from DB) ──
        $uptime = 99.97;
        $uptimeColor = $uptime >= 99.9 ? 'success' : ($uptime >= 99.0 ? 'warning' : 'danger');
        $uptimeIcon  = $uptime >= 99.9 ? 'heroicon-o-check-circle' : 'heroicon-o-exclamation-circle';

        return [
            Stat::make('Monthly Recurring Revenue (MRR)', '₵' . number_format($mrr, 2))
                ->description('↑ 12.4% from last month')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart($mrrTrend),

            Stat::make('30-Day Gross GMV', '₵' . number_format($gmv, 2))
                ->description('E-store sales last 30 days')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('info')
                ->chart([12000, 13500, 14200, 15100, 16800, 17500, 18000, 18320]),

            Stat::make('Cash Runway', $runway . ' months')
                ->description('At current burn rate')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color($runway >= 12 ? 'success' : ($runway >= 6 ? 'warning' : 'danger')),

            Stat::make('Server / API Uptime', $uptime . '%')
                ->description($uptime >= 99.9 ? '🟢 All systems operational' : '🟡 Degraded performance')
                ->descriptionIcon($uptimeIcon)
                ->color($uptimeColor),
        ];
    }
}
