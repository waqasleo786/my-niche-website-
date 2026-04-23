<?php

declare(strict_types=1);

namespace App\Filament\Resources\Orders\Pages;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Filament\Resources\Orders\OrderResource;
use App\Mail\PaymentRejectedMail;
use App\Mail\PaymentVerifiedMail;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

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

    private function verifyPaymentAction(): Action
    {
        return Action::make('verifyPayment')
            ->label('Verify Payment')
            ->icon('heroicon-o-check-circle')
            ->color('success')
            ->requiresConfirmation()
            ->modalHeading('Verify Payment')
            ->modalDescription('This will mark the payment as verified and move the order to Processing. An email will be sent to the customer.')
            ->modalSubmitActionLabel('Yes, Verify Payment')
            ->visible(fn () => $this->record->hasPaymentSlip()
                && $this->record->payment_status !== PaymentStatus::Paid)
            ->action(function (): void {
                $this->record->update([
                    'payment_status'     => PaymentStatus::Paid,
                    'status'             => OrderStatus::Processing,
                    'payment_verified_at' => now(),
                ]);

                Mail::to($this->record->user->email)
                    ->send(new PaymentVerifiedMail($this->record));

                Notification::make()
                    ->title('Payment verified!')
                    ->body('Order moved to Processing. Customer notified via email.')
                    ->success()
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
                    ->placeholder('e.g. Screenshot is blurry, amount does not match, transaction ID not visible...')
                    ->required()
                    ->rows(3)
                    ->maxLength(500),
            ])
            ->modalHeading('Reject Payment Slip')
            ->modalDescription('The customer will be notified via email with your rejection reason.')
            ->modalSubmitActionLabel('Reject & Notify Customer')
            ->visible(fn () => $this->record->hasPaymentSlip()
                && $this->record->payment_status !== PaymentStatus::Paid
                && $this->record->payment_status !== PaymentStatus::Failed)
            ->action(function (array $data): void {
                $reason = $data['rejection_reason'];

                $this->record->update([
                    'payment_status'           => PaymentStatus::Failed,
                    'status'                   => OrderStatus::PaymentRejected,
                    'payment_rejected_reason'  => $reason,
                ]);

                Mail::to($this->record->user->email)
                    ->send(new PaymentRejectedMail($this->record, $reason));

                Notification::make()
                    ->title('Payment rejected')
                    ->body('Customer notified via email with the rejection reason.')
                    ->warning()
                    ->send();

                $this->refreshFormData(['status', 'payment_status', 'payment_rejected_reason']);
            });
    }
}
