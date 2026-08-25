<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Account Credentials & Access')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn (?string $state): ?string => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->helperText('Leave empty to keep the existing password.'),

                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->label('Email Verified At')
                            ->native(false),

                        Forms\Components\Toggle::make('is_super_admin')
                            ->label('Super Admin / Monarch Access')
                            ->helperText('Grants access to this Filament Admin Panel.')
                            ->default(false),
                    ])->columns(2),

                Forms\Components\Section::make('Single Sign-On (SSO)')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('provider')
                            ->label('SSO Provider')
                            ->placeholder('e.g. google, microsoft')
                            ->disabled(),

                        Forms\Components\TextInput::make('provider_id')
                            ->label('SSO Provider ID')
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Contact & Address Information')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('address_street')
                            ->label('Street Address')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('address_city')
                            ->label('City')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('address_region')
                            ->label('Region / State')
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Preferences & Notifications')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('language')
                            ->default('English (Default)'),

                        Forms\Components\TextInput::make('currency')
                            ->default('GHS — Ghanaian Cedi'),

                        Forms\Components\Grid::make(4)
                            ->schema([
                                Forms\Components\Toggle::make('notif_orders')
                                    ->label('Order Notifications')
                                    ->default(true),

                                Forms\Components\Toggle::make('notif_promos')
                                    ->label('Promo Notifications')
                                    ->default(false),

                                Forms\Components\Toggle::make('notif_blog')
                                    ->label('Blog Notifications')
                                    ->default(false),

                                Forms\Components\Toggle::make('notif_security')
                                    ->label('Security Notifications')
                                    ->default(true),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),

                Tables\Columns\TextColumn::make('provider')
                    ->label('Auth Provider')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'google' => 'info',
                        'microsoft', 'azure' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state): string => filled($state) ? ucfirst($state) : 'Email/Password'),

                Tables\Columns\IconColumn::make('is_super_admin')
                    ->label('Admin')
                    ->boolean(),

                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label('Verified')
                    ->dateTime('M d, Y')
                    ->placeholder('Unverified')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registered')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_super_admin')
                    ->label('Admin Status')
                    ->trueLabel('Super Admins only')
                    ->falseLabel('Standard Users only'),

                Tables\Filters\SelectFilter::make('provider')
                    ->label('Auth Provider')
                    ->options([
                        'google' => 'Google',
                        'microsoft' => 'Microsoft',
                        'azure' => 'Azure',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
