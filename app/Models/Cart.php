<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
    ];

    // -------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    // -------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------

    public function getTotalItems(): int
    {
        return $this->items->sum('quantity');
    }

    public function getSubtotal(): float
    {
        return (float) $this->items->sum(fn (CartItem $item) => $item->unit_price * $item->quantity);
    }

    public function getFormattedSubtotal(): string
    {
        return 'Rs. ' . number_format($this->getSubtotal(), 2);
    }
}
