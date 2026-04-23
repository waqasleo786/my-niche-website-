<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewPaymentSlipAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Order $order) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🔔 New Payment Slip — Order ' . $this->order->order_number . ' Needs Verification',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.new-payment-slip-alert',
        );
    }
}
