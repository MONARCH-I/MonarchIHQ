<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Order Info')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->options(Order::STATUSES)
                        ->required(),

                    Forms\Components\TextInput::make('currency')
                        ->default('GHS')
                        ->maxLength(3),

                    Forms\Components\TextInput::make('customer_name'),
                    Forms\Components\TextInput::make('customer_email')->email(),
                    Forms\Components\TextInput::make('customer_phone'),

                    Forms\Components\Textarea::make('shipping_address')->rows(3)->columnSpanFull(),
                    Forms\Components\Textarea::make('notes')->rows(2)->columnSpanFull(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Order #')
                    ->sortable()
                    ->prefix('#'),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Customer')
                    ->placeholder('Guest')
                    ->searchable(),

                Tables\Columns\TextColumn::make('customer_email')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'pending'    => 'gray',
                        'processing' => 'info',
                        'shipped'    => 'warning',
                        'delivered'  => 'success',
                        'cancelled'  => 'danger',
                    }),

                Tables\Columns\TextColumn::make('total')
                    ->money('GHS')
                    ->sortable(),

                Tables\Columns\TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Placed')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(Order::STATUSES),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Update Status'),
                Tables\Actions\ViewAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit'   => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
