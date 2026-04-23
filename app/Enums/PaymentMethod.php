<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentMethod: string
{
    case COD          = 'cod';
    case JazzCash     = 'jazzcash';
    case EasyPaisa    = 'easypaisa';
    case BankTransfer = 'bank_transfer';

    public function label(): string
    {
        return match($this) {
            self::COD          => 'Cash on Delivery',
            self::JazzCash     => 'JazzCash',
            self::EasyPaisa    => 'EasyPaisa',
            self::BankTransfer => 'Bank Transfer',
        };
    }

    public function requiresSlip(): bool
    {
        return match($this) {
            self::COD          => false,
            self::JazzCash,
            self::EasyPaisa,
            self::BankTransfer => true,
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
