<?php

declare(strict_types=1);

namespace App\Filament\Resources\QuoteRequests\Pages;

use App\Enums\QuoteStatus;
use App\Filament\Resources\QuoteRequests\QuoteRequestResource;
use Filament\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ViewQuoteRequest extends ViewRecord
{
    protected static string $resource = QuoteRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('mark_reviewed')
                ->label('Mark Reviewed')
                ->color('info')
                ->icon('heroicon-o-eye')
                ->visible(fn () => $this->record->status === QuoteStatus::Pending)
                ->action(function () {
                    $this->record->update(['status' => QuoteStatus::Reviewed]);
                }),

            Action::make('mark_quoted')
                ->label('Mark Quoted')
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->visible(fn () => $this->record->status === QuoteStatus::Reviewed)
                ->action(function () {
                    $this->record->update(['status' => QuoteStatus::Quoted]);
                }),

            Action::make('mark_closed')
                ->label('Close Quote')
                ->color('gray')
                ->icon('heroicon-o-x-circle')
                ->visible(fn () => $this->record->status !== QuoteStatus::Closed)
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => QuoteStatus::Closed]);
                }),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Client Information')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('user.name')->label('Name'),
                        TextEntry::make('user.email')->label('Email'),
                        TextEntry::make('user.phone')->label('Phone')->default('—'),
                    ]),

                Section::make('Quote Details')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('gift_box_name')->label('Box Selected'),
                        TextEntry::make('total_boxes')->label('Total Quantity')->suffix(' pcs'),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (QuoteStatus $state): string => $state->color())
                            ->formatStateUsing(fn (QuoteStatus $state): string => $state->label()),
                    ]),

                Section::make('Selected Products')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->schema([
                                TextEntry::make('product_name')->label('Product'),
                                TextEntry::make('qty_per_box')->label('Qty/Box')->suffix(' pc(s)'),
                                TextEntry::make('unit_price')
                                    ->label('Unit Price')
                                    ->formatStateUsing(fn ($state) => 'Rs. ' . number_format((float) $state, 2)),
                                TextEntry::make('line_total')
                                    ->label('Line Total')
                                    ->formatStateUsing(fn ($state) => 'Rs. ' . number_format((float) $state, 2)),
                            ])
                            ->columns(4),
                    ]),

                Section::make('Pricing Breakdown')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('items_total_per_box')
                            ->label('Items Cost / Box')
                            ->formatStateUsing(fn ($state) => 'Rs. ' . number_format((float) $state, 2)),

                        TextEntry::make('box_price_per_box')
                            ->label('Box Cost / Box')
                            ->formatStateUsing(fn ($state) => 'Rs. ' . number_format((float) $state, 2)),

                        TextEntry::make('grand_total')
                            ->label('Grand Total')
                            ->formatStateUsing(fn ($state) => 'Rs. ' . number_format((float) $state, 2)),
                    ]),

                Section::make('Admin Notes')
                    ->schema([
                        TextEntry::make('admin_notes')
                            ->label('')
                            ->default('No notes yet.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
