<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

/**
 * High Priority Tickets Widget
 *
 * Uses mock data for now. When you add a SupportTicket model, replace:
 *   ->query(SupportTicket::query()->where('priority','high')->where('status','open'))
 * And remove the emptyState overrides.
 */
class HighPriorityTicketsTableWidget extends BaseWidget
{
    protected static ?string $heading = '🔴 High Priority Open Support Tickets';

    protected static ?int $sort = 10;

    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\Customer::query()->whereRaw('0 = 1'))
            ->columns([
                Tables\Columns\TextColumn::make('ticket_id')->label('#'),
                Tables\Columns\TextColumn::make('subject')->label('Subject'),
                Tables\Columns\TextColumn::make('customer')->label('Customer'),
                Tables\Columns\TextColumn::make('product_area')->label('Product'),
                Tables\Columns\TextColumn::make('age')->label('Open For'),
            ])
            ->paginated(false)
            ->emptyStateHeading('No high-priority tickets')
            ->emptyStateDescription('Connect your support system (e.g. Freshdesk, Zendesk) to populate this widget.');
    }
}
