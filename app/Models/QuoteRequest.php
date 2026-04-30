<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\QuoteStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteRequest extends Model
{
    protected $fillable = [
        'user_id',
        'gift_box_id',
        'gift_box_name',
        'total_boxes',
        'items',
        'items_total_per_box',
        'box_price_per_box',
        'grand_total',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'items'               => 'array',
        'items_total_per_box' => 'decimal:2',
        'box_price_per_box'   => 'decimal:2',
        'grand_total'         => 'decimal:2',
        'total_boxes'         => 'integer',
        'status'              => QuoteStatus::class,
    ];

    // -------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function giftBox(): BelongsTo
    {
        return $this->belongsTo(GiftBox::class);
    }

    // -------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------

    public function getFormattedGrandTotal(): string
    {
        return 'Rs. ' . number_format((float) $this->grand_total, 2);
    }
}
