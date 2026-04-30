<?php

declare(strict_types=1);

namespace App\Filament\Resources\GiftBoxes\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GiftBoxesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable()
                    ->width(50),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('capacity_units')
                    ->label('Capacity')
                    ->suffix(' units')
                    ->sortable(),

                TextColumn::make('price_tier1')
                    ->label('50-99 pcs')
                    ->money('PKR')
                    ->sortable(),

                TextColumn::make('price_tier2')
                    ->label('100-199 pcs')
                    ->money('PKR'),

                TextColumn::make('price_tier3')
                    ->label('200-499 pcs')
                    ->money('PKR'),

                TextColumn::make('price_tier4')
                    ->label('500+ pcs')
                    ->money('PKR'),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                TextColumn::make('quote_requests_count')
                    ->label('Quotes')
                    ->counts('quoteRequests')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
