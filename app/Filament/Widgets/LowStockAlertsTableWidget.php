<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LowStockAlertsTableWidget extends BaseWidget
{
    protected static ?string $heading = '⚠️ Low Stock & Out of Stock Alerts';

    protected static ?int $sort = 7;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->where('is_active', true)
                    ->whereColumn('stock_quantity', '<=', 'min_stock_threshold')
                    ->orderBy('stock_quantity')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->copyable()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('stock_quantity')
                    ->label('Qty on Hand')
                    ->badge()
                    ->color(fn ($record) => $record->stock_quantity === 0 ? 'danger' : 'warning')
                    ->formatStateUsing(fn ($state) => $state === 0 ? '0 — Out of Stock' : $state . ' remaining'),

                Tables\Columns\TextColumn::make('min_stock_threshold')
                    ->label('Reorder Threshold')
                    ->color('gray'),

                Tables\Columns\TextColumn::make('price')
                    ->money('GHS')
                    ->label('Unit Price'),
            ])
            ->actions([
                Tables\Actions\Action::make('restock')
                    ->label('Restock')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->url(fn (Product $record) => route('filament.monarch.resources.products.edit', $record))
                    ->color('warning'),
            ])
            ->paginated([5, 10, 25]);
    }
}
