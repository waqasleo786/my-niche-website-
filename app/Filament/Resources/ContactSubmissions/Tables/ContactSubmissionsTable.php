<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactSubmissions\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ContactSubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Email copied'),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('message')
                    ->label('Message')
                    ->limit(80)
                    ->tooltip(fn ($record) => $record->message)
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->searchable()
            ->filters([
                Filter::make('this_month')
                    ->label('This Month')
                    ->query(fn (Builder $query) => $query->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)),
            ])
            ->actions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->emptyStateIcon('heroicon-o-envelope')
            ->emptyStateHeading('No contact messages yet')
            ->emptyStateDescription('When visitors submit the contact form, their messages will appear here.');
    }
}
