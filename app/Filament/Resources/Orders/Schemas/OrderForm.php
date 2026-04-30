<?php

declare(strict_types=1);

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

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

                Section::make('Payment Slip')
                    ->description('Customer uploaded payment receipt for manual verification.')
                    ->schema([
                        Placeholder::make('payment_method_label')
                            ->label('Payment Method')
                            ->content(fn ($record) => $record?->payment_method?->label() ?? '—'),

                        Placeholder::make('payment_slip_preview')
                            ->label('Payment Slip')
                            ->content(function ($record) {
                                if (! $record?->payment_slip_path) {
                                    return 'No slip uploaded.';
                                }

                                $url = Storage::disk('public')->url($record->payment_slip_path);
                                $ext = strtolower(pathinfo($record->payment_slip_path, PATHINFO_EXTENSION));

                                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<a href="' . $url . '" target="_blank">'
                                        . '<img src="' . $url . '" alt="Payment Slip" class="max-w-sm max-h-64 rounded-lg border border-gray-200 shadow-sm hover:opacity-90 transition-opacity">'
                                        . '<p class="mt-1 text-xs text-gray-500">Click to open full size</p>'
                                        . '</a>'
                                    );
                                }

                                return new \Illuminate\Support\HtmlString(
                                    '<a href="' . $url . '" target="_blank" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">'
                                    . '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>'
                                    . 'View PDF Slip'
                                    . '</a>'
                                );
                            })
                            ->columnSpanFull(),

                        Placeholder::make('payment_deadline_at')
                            ->label('Verification Deadline')
                            ->content(fn ($record) => $record?->payment_deadline_at?->format('d M Y, h:i A') ?? '—'),

                        Placeholder::make('payment_verified_at')
                            ->label('Verified At')
                            ->content(fn ($record) => $record?->payment_verified_at?->format('d M Y, h:i A') ?? '—'),

                        Placeholder::make('payment_rejected_reason')
                            ->label('Rejection Reason')
                            ->content(fn ($record) => $record?->payment_rejected_reason ?? '—'),
                    ])
                    ->visible(fn ($record) => $record?->hasPaymentSlip() || $record?->payment_method?->requiresSlip()),

                Section::make('Order Items')
                    ->schema([
                        Placeholder::make('items_table')
                            ->label('')
                            ->columnSpanFull()
                            ->content(function ($record) {
                                if (! $record || $record->items->isEmpty()) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<p class="text-sm text-gray-500">No items found.</p>'
                                    );
                                }

                                $rows = '';
                                foreach ($record->items as $item) {
                                    $productName = $item->product?->name ?? 'Product Deleted';
                                    $sku         = $item->product?->sku
                                        ? '<span style="font-size:11px;color:#9ca3af;display:block;margin-top:2px;">' . e($item->product->sku) . '</span>'
                                        : '';
                                    $rows .= '<tr style="border-bottom:1px solid #f3f4f6;">'
                                        . '<td style="padding:10px 16px 10px 0;font-size:13px;color:#111827;width:55%;">' . e($productName) . $sku . '</td>'
                                        . '<td style="padding:10px 16px;font-size:13px;color:#6b7280;text-align:center;width:10%;">' . $item->quantity . '</td>'
                                        . '<td style="padding:10px 16px;font-size:13px;color:#6b7280;text-align:right;width:17.5%;">Rs. ' . number_format((float) $item->unit_price, 2) . '</td>'
                                        . '<td style="padding:10px 0 10px 16px;font-size:13px;font-weight:600;color:#111827;text-align:right;width:17.5%;">Rs. ' . number_format((float) $item->total_price, 2) . '</td>'
                                        . '</tr>';
                                }

                                return new \Illuminate\Support\HtmlString('
                                    <div style="overflow-x:auto;">
                                        <table style="width:100%;border-collapse:collapse;table-layout:fixed;">
                                            <thead>
                                                <tr style="border-bottom:2px solid #e5e7eb;">
                                                    <th style="padding:0 16px 8px 0;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#6b7280;text-align:left;width:55%;">Product</th>
                                                    <th style="padding:0 16px 8px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#6b7280;text-align:center;width:10%;">Qty</th>
                                                    <th style="padding:0 16px 8px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#6b7280;text-align:right;width:17.5%;">Unit Price</th>
                                                    <th style="padding:0 0 8px 16px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#6b7280;text-align:right;width:17.5%;">Line Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>' . $rows . '</tbody>
                                        </table>
                                    </div>
                                ');
                            }),
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
                            ->content(fn ($record) => $record ? 'Rs. ' . number_format((float) $record->subtotal, 2) : '-'),

                        Placeholder::make('shipping_cost')
                            ->label('Shipping')
                            ->content(fn ($record) => $record ? 'Rs. ' . number_format((float) $record->shipping_cost, 2) : '-'),

                        Placeholder::make('total')
                            ->label('Total')
                            ->content(fn ($record) => $record ? 'Rs. ' . number_format((float) $record->total, 2) : '-'),
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
