<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

/**
 * Active Custom Projects Widget
 *
 * Uses mock data via a static Eloquent-compatible approach.
 * When you add a `Project` model, swap the getTableQuery() method with:
 *   return Project::query()->where('status', '!=', 'completed')->latest();
 * And remove the getTableRecords() override entirely.
 */
class ActiveProjectsTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Active Custom Development Projects';

    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\Customer::query()->whereRaw('0 = 1')) // empty placeholder
            ->columns([
                Tables\Columns\TextColumn::make('project_name')
                    ->label('Project Name')
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('client')
                    ->label('Client')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'In Progress' => 'info',
                        'In Review'   => 'warning',
                        'Blocked'     => 'danger',
                        'Completed'   => 'success',
                        default       => 'gray',
                    }),

                Tables\Columns\TextColumn::make('estimated_hours')
                    ->label('Est. Hours')
                    ->suffix('h'),

                Tables\Columns\TextColumn::make('logged_hours')
                    ->label('Logged')
                    ->suffix('h'),

                Tables\Columns\TextColumn::make('deadline')
                    ->label('Deadline'),
            ])
            ->paginated(false)
            ->emptyStateHeading('No active projects')
            ->emptyStateDescription('Wire this to your Project model to show live data.');
    }
}
