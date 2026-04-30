<?php

declare(strict_types=1);

namespace App\Enums;

enum QuoteStatus: string
{
    case Pending  = 'pending';
    case Reviewed = 'reviewed';
    case Quoted   = 'quoted';
    case Closed   = 'closed';

    public function label(): string
    {
        return match($this) {
            self::Pending  => 'Pending',
            self::Reviewed => 'Reviewed',
            self::Quoted   => 'Quoted',
            self::Closed   => 'Closed',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Pending  => 'warning',
            self::Reviewed => 'info',
            self::Quoted   => 'success',
            self::Closed   => 'gray',
        };
    }
}
