<?php

declare(strict_types=1);

namespace App\Filament\Resources\Orders\Tables;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->label('Order #')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (OrderStatus $state): string => $state->color())
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->label('Payment')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->label('Paid')
                    ->badge()
                    ->color(fn (PaymentStatus $state): string => $state->color())
                    ->sortable(),

                IconColumn::make('payment_slip_path')
                    ->label('Slip')
                    ->boolean()
                    ->trueIcon('heroicon-o-paper-clip')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->getStateUsing(fn ($record) => ! empty($record->payment_slip_path)),

                TextColumn::make('total')
                    ->label('Total (PKR)')
                    ->money('PKR')
                    ->sortable(),

                TextColumn::make('shipping_city')
                    ->label('City')
                    ->searchable(),

                IconColumn::make('is_b2b')
                    ->label('B2B')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(OrderStatus::class),

                SelectFilter::make('payment_status')
                    ->options(PaymentStatus::class),

                TernaryFilter::make('payment_slip_path')
                    ->label('Has Slip')
                    ->nullable()
                    ->trueLabel('Slip submitted')
                    ->falseLabel('No slip'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
