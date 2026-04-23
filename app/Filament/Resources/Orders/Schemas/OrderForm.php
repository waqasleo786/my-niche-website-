<?php

declare(strict_types=1);

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Order Information')
                    ->columns(2)
                    ->schema([
                        Placeholder::make('order_number')
                            ->label('Order #')
                            ->content(fn ($record) => $record?->order_number ?? 'Will be auto-generated'),

                        Placeholder::make('customer')
                            ->label('Customer')
                            ->content(fn ($record) => $record?->user?->name ?? 'Guest'),

                        Select::make('status')
                            ->options(OrderStatus::class)
                            ->default(OrderStatus::Pending->value)
                            ->required()
                            ->native(false),

                        Select::make('payment_status')
                            ->options(PaymentStatus::class)
                            ->default(PaymentStatus::Pending->value)
                            ->required()
                            ->native(false),
                    ]),

                Section::make('Shipping Details')
                    ->columns(2)
                    ->schema([
                        Placeholder::make('shipping_name')
                            ->label('Name')
                            ->content(fn ($record) => $record?->shipping_name),

                        Placeholder::make('shipping_phone')
                            ->label('Phone')
                            ->content(fn ($record) => $record?->shipping_phone),

                        Placeholder::make('shipping_address')
                            ->label('Address')
                            ->content(fn ($record) => $record?->shipping_address),

                        Placeholder::make('shipping_city')
                            ->label('City')
                            ->content(fn ($record) => $record?->shipping_city),
                    ]),

                Section::make('Financial')
                    ->columns(3)
                    ->schema([
                        Placeholder::make('subtotal')
                            ->label('Subtotal')
                            ->content(fn ($record) => $record ? 'Rs. ' . number_format($record->subtotal, 2) : '-'),

                        Placeholder::make('shipping_cost')
                            ->label('Shipping')
                            ->content(fn ($record) => $record ? 'Rs. ' . number_format($record->shipping_cost, 2) : '-'),

                        Placeholder::make('total')
                            ->label('Total')
                            ->content(fn ($record) => $record ? 'Rs. ' . number_format($record->total, 2) : '-'),
                    ]),

                Section::make('Notes')
                    ->schema([
                        Textarea::make('notes')
                            ->columnSpanFull()
                            ->rows(3),
                    ]),

            ]);
    }
}
