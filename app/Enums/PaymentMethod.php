<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentMethod: string
{
    case COD       = 'cod';
    case JazzCash  = 'jazzcash';
    case EasyPaisa = 'easypaisa';

    public function label(): string
    {
        return match($this) {
            self::COD       => 'Cash on Delivery',
            self::JazzCash  => 'JazzCash',
            self::EasyPaisa => 'EasyPaisa',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
