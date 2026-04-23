<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderStatus: string
{
    case Pending         = 'pending';
    case PaymentPending  = 'payment_pending';
    case PaymentRejected = 'payment_rejected';
    case Confirmed       = 'confirmed';
    case Processing      = 'processing';
    case Shipped         = 'shipped';
    case Delivered       = 'delivered';
    case Cancelled       = 'cancelled';

    public function label(): string
    {
        return match($this) {
            self::Pending         => 'Pending',
            self::PaymentPending  => 'Awaiting Payment Verification',
            self::PaymentRejected => 'Payment Rejected',
            self::Confirmed       => 'Confirmed',
            self::Processing      => 'Processing',
            self::Shipped         => 'Shipped',
            self::Delivered       => 'Delivered',
            self::Cancelled       => 'Cancelled',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Pending         => 'yellow',
            self::PaymentPending  => 'orange',
            self::PaymentRejected => 'red',
            self::Confirmed       => 'blue',
            self::Processing      => 'purple',
            self::Shipped         => 'indigo',
            self::Delivered       => 'green',
            self::Cancelled       => 'red',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
