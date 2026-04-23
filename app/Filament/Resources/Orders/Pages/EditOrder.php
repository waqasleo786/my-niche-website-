<?php

declare(strict_types=1);

namespace App\Filament\Resources\Orders\Pages;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->verifyPaymentAction(),
            $this->rejectPaymentAction(),
            DeleteAction::make(),
        ];
    }

    private function waPhone(): string
    {
        return '92' . ltrim($this->record->shipping_phone, '0');
    }

    private function verifyPaymentAction(): Action
    {
        return Action::make('verifyPayment')
            ->label('Verify Payment')
            ->icon('heroicon-o-check-circle')
            ->color('success')
            ->requiresConfirmation()
            ->modalHeading('Verify Payment')
            ->modalDescription('This will mark the payment as verified and move the order to Processing.')
            ->modalSubmitActionLabel('Yes, Verify Payment')
            ->visible(fn () => $this->record->hasPaymentSlip()
                && $this->record->payment_status !== PaymentStatus::Paid)
            ->action(function (): void {
                $this->record->update([
                    'payment_status'      => PaymentStatus::Paid,
                    'status'              => OrderStatus::Processing,
                    'payment_verified_at' => now(),
                ]);

                $msg = urlencode(
                    'Assalam o Alaikum ' . $this->record->shipping_name . '! '
                    . 'Aap ka payment verify ho gaya. Order #' . $this->record->order_number
                    . ' ab process ho raha hai. Jald hi dispatch karein ge. Shukriya! — Shahid Brothers'
                );

                Notification::make()
                    ->title('Payment verified! ✅')
                    ->body('Customer ko WhatsApp pe notify karein.')
                    ->actions([
                        \Filament\Notifications\Actions\Action::make('whatsapp')
                            ->label('Send WhatsApp')
                            ->url('https://wa.me/' . $this->waPhone() . '?text=' . $msg)
                            ->openUrlInNewTab()
                            ->button()
                            ->color('success'),
                    ])
                    ->success()
                    ->persistent()
                    ->send();

                $this->refreshFormData(['status', 'payment_status', 'payment_verified_at']);
            });
    }

    private function rejectPaymentAction(): Action
    {
        return Action::make('rejectPayment')
            ->label('Reject Payment')
            ->icon('heroicon-o-x-circle')
            ->color('danger')
            ->form([
                Textarea::make('rejection_reason')
                    ->label('Reason for rejection')
                    ->placeholder('e.g. Screenshot blurry hai, amount match nahi karta, transaction ID nahi dikh raha...')
                    ->required()
                    ->rows(3)
                    ->maxLength(500),
            ])
            ->modalHeading('Reject Payment Slip')
            ->modalDescription('Customer ko WhatsApp pe reason batayein.')
            ->modalSubmitActionLabel('Reject & Notify via WhatsApp')
            ->visible(fn () => $this->record->hasPaymentSlip()
                && $this->record->payment_status !== PaymentStatus::Paid
                && $this->record->payment_status !== PaymentStatus::Failed)
            ->action(function (array $data): void {
                $reason = $data['rejection_reason'];

                $this->record->update([
                    'payment_status'          => PaymentStatus::Failed,
                    'status'                  => OrderStatus::PaymentRejected,
                    'payment_rejected_reason' => $reason,
                ]);

                $msg = urlencode(
                    'Assalam o Alaikum ' . $this->record->shipping_name . '! '
                    . 'Order #' . $this->record->order_number . ' ka payment slip verify nahi ho saka. '
                    . 'Wajah: ' . $reason . '. '
                    . 'Kripya dobara clear screenshot send karein. Shukriya! — Shahid Brothers'
                );

                Notification::make()
                    ->title('Payment rejected ❌')
                    ->body('Customer ko WhatsApp pe reason bhejein.')
                    ->actions([
                        \Filament\Notifications\Actions\Action::make('whatsapp')
                            ->label('Send WhatsApp')
                            ->url('https://wa.me/' . $this->waPhone() . '?text=' . $msg)
                            ->openUrlInNewTab()
                            ->button()
                            ->color('danger'),
                    ])
                    ->danger()
                    ->persistent()
                    ->send();

                $this->refreshFormData(['status', 'payment_status', 'payment_rejected_reason']);
            });
    }
}
