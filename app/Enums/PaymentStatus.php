<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentStatus: string
{
    case Pending  = 'pending';
    case Paid     = 'paid';
    case Failed   = 'failed';
    case Refunded = 'refunded';

    public function label(): string
    {
        return match($this) {
            self::Pending  => 'Pending',
            self::Paid     => 'Paid',
            self::Failed   => 'Failed',
            self::Refunded => 'Refunded',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Pending  => 'yellow',
            self::Paid     => 'green',
            self::Failed   => 'red',
            self::Refunded => 'gray',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
