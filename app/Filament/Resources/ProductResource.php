<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    // ── FORM ─────────────────────────────────────────────────────────────────

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Product Identity')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Forms\Set $set) =>
                            $set('slug', \Illuminate\Support\Str::slug($state))
                        ),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                    Forms\Components\TextInput::make('sku')
                        ->label('SKU')
                        ->unique(ignoreRecord: true)
                        ->placeholder('MHQ-XXXXXX')
                        ->maxLength(100),

                    Forms\Components\Select::make('category_id')
                        ->label('Category')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                ])->columns(2),

            Forms\Components\Section::make('Description')
                ->schema([
                    Forms\Components\TextInput::make('short_description')
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('description')
                        ->rows(5)
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Pricing')
                ->schema([
                    Forms\Components\TextInput::make('price')
                        ->numeric()
                        ->prefix('₵')
                        ->required()
                        ->minValue(0),

                    Forms\Components\TextInput::make('sale_price')
                        ->numeric()
                        ->prefix('₵')
                        ->nullable()
                        ->minValue(0)
                        ->helperText('Leave empty if not on sale.'),
                ])->columns(2),

            Forms\Components\Section::make('Inventory')
                ->schema([
                    Forms\Components\TextInput::make('stock_quantity')
                        ->numeric()
                        ->required()
                        ->default(0)
                        ->minValue(0),

                    Forms\Components\TextInput::make('min_stock_threshold')
                        ->label('Low Stock Alert Threshold')
                        ->numeric()
                        ->default(5)
                        ->minValue(0)
                        ->helperText('Triggers a low-stock alert in the dashboard.'),
                ])->columns(2),

            Forms\Components\Section::make('Store Appearance')
                ->schema([
                    Forms\Components\Select::make('card_style')
                        ->label('Featured Card Style')
                        ->options([
                            'light' => 'Light (white)',
                            'dark'  => 'Dark (black)',
                            'promo' => 'Promo (gradient)',
                        ])
                        ->default('light')
                        ->required(),

                    Forms\Components\TextInput::make('badge_text')
                        ->label('Custom Badge Label')
                        ->placeholder('e.g. Pre-Order, Limited Offer')
                        ->datalist([
                            'Pre-Order',
                            'Limited Offer',
                            'New',
                            'Special Edition',
                        ])
                        ->helperText('Leave empty to use automatic system badge (Popular, Limited Quantity, Restock Soon).')
                        ->maxLength(30),

                    Forms\Components\Select::make('badge_color')
                        ->label('Badge Color')
                        ->options([
                            'orange' => 'Orange (Pre-Order / Warm)',
                            'red'    => 'Red (Limited Offer / Sale)',
                            'green'  => 'Green (New)',
                            'blue'   => 'Blue (Popular / Featured)',
                            'gray'   => 'Gray (Muted)',
                        ])
                        ->default('orange'),

                    Forms\Components\Toggle::make('is_featured')
                        ->label('Show in "New Products" Carousel')
                        ->default(false),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Visible in Store')
                        ->default(true),
                ])->columns(2),

            Forms\Components\Section::make('Images')
                ->schema([
                    Forms\Components\FileUpload::make('image_path')
                        ->label('Main Product Image')
                        ->image()
                        ->disk('public')
                        ->directory('products')
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('1:1')
                        ->imageResizeTargetWidth('800')
                        ->imageResizeTargetHeight('800')
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('gallery')
                        ->label('Gallery Images')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->disk('public')
                        ->directory('products/gallery')
                        ->columnSpanFull(),
                ]),

        ]);
    }

    // ── TABLE ─────────────────────────────────────────────────────────────────

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('')
                    ->disk('public')
                    ->square()
                    ->defaultImageUrl(fn ($record) => 'https://placehold.co/60x60/f0f0f0/999?text='.urlencode($record->name[0]))
                    ->size(52),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->money('GHS')
                    ->sortable(),

                Tables\Columns\TextColumn::make('sale_price')
                    ->label('Sale Price')
                    ->money('GHS')
                    ->placeholder('—')
                    ->color('danger'),

                Tables\Columns\TextColumn::make('stock_quantity')
                    ->label('Stock')
                    ->sortable()
                    ->badge()
                    ->color(fn ($record) => match ($record->stock_status) {
                        'in_stock'    => 'success',
                        'low_stock'   => 'warning',
                        'out_of_stock'=> 'danger',
                    })
                    ->formatStateUsing(fn ($state, $record) => match ($record->stock_status) {
                        'in_stock'    => $state . ' In Stock',
                        'low_stock'   => $state . ' Low',
                        'out_of_stock'=> 'Out of Stock',
                    }),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Added')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label('Category'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured'),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),

                Tables\Filters\Filter::make('low_stock')
                    ->label('Low Stock / Out of Stock')
                    ->query(fn (Builder $query) => $query->whereColumn('stock_quantity', '<=', 'min_stock_threshold')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
