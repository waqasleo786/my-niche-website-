<?php

declare(strict_types=1);

namespace App\Filament\Resources\QuoteRequests\Tables;

use App\Enums\QuoteStatus;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class QuoteRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('gift_box_name')
                    ->label('Box')
                    ->searchable(),

                TextColumn::make('total_boxes')
                    ->label('Qty')
                    ->suffix(' pcs')
                    ->sortable(),

                TextColumn::make('grand_total')
                    ->label('Grand Total')
                    ->money('PKR')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (QuoteStatus $state): string => $state->color())
                    ->formatStateUsing(fn (QuoteStatus $state): string => $state->label())
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options(collect(QuoteStatus::cases())->mapWithKeys(
                        fn (QuoteStatus $s) => [$s->value => $s->label()]
                    )),
            ])
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
