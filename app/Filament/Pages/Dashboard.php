<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ActiveProjectsTableWidget;
use App\Filament\Widgets\AgencyStatsWidget;
use App\Filament\Widgets\EstoreSalesVolumeChartWidget;
use App\Filament\Widgets\GlobalOverviewStatsWidget;
use App\Filament\Widgets\HighPriorityTicketsTableWidget;
use App\Filament\Widgets\LowStockAlertsTableWidget;
use App\Filament\Widgets\SaasCacVsLtvChartWidget;
use App\Filament\Widgets\SaasChurnRateChartWidget;
use App\Filament\Widgets\SupportTicketsPieChartWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $title = 'MonarchiHQ Dashboard';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?int $navigationSort = 1;

    /**
     * All widgets registered in the panel — we group them by returning them all here.
     * The sort property on each widget determines the order within the page.
     */
    public function getWidgets(): array
    {
        return [
            // ── Row 0: Account info ──────────────────────────────────────────
            AccountWidget::class,

            // ── Row 1: CEO Global Overview ───────────────────────────────────
            GlobalOverviewStatsWidget::class,

            // ── Row 2: SaaS Charts ───────────────────────────────────────────
            SaasChurnRateChartWidget::class,
            SaasCacVsLtvChartWidget::class,

            // ── Row 3: Agency / Custom Dev ───────────────────────────────────
            AgencyStatsWidget::class,
            ActiveProjectsTableWidget::class,

            // ── Row 4: E-Store & Hardware ────────────────────────────────────
            LowStockAlertsTableWidget::class,
            EstoreSalesVolumeChartWidget::class,

            // ── Row 5: CRM / Support ─────────────────────────────────────────
            SupportTicketsPieChartWidget::class,
            HighPriorityTicketsTableWidget::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return 2;
    }
}
