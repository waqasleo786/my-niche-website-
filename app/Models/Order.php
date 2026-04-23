<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'is_b2b',
        'status',
        'payment_method',
        'payment_status',
        'subtotal',
        'shipping_cost',
        'total',
        'shipping_name',
        'shipping_phone',
        'shipping_province',
        'shipping_city',
        'shipping_area',
        'shipping_address',
        'notes',
        'payment_slip_path',
        'payment_verified_at',
        'payment_rejected_reason',
        'payment_deadline_at',
    ];

    protected $casts = [
        'is_b2b'               => 'boolean',
        'status'               => OrderStatus::class,
        'payment_method'       => PaymentMethod::class,
        'payment_status'       => PaymentStatus::class,
        'subtotal'             => 'decimal:2',
        'shipping_cost'        => 'decimal:2',
        'total'                => 'decimal:2',
        'payment_verified_at'  => 'datetime',
        'payment_deadline_at'  => 'datetime',
    ];

    public function hasPaymentSlip(): bool
    {
        return ! empty($this->payment_slip_path);
    }

    public function isAwaitingVerification(): bool
    {
        return $this->hasPaymentSlip()
            && $this->payment_status === PaymentStatus::SlipSubmitted;
    }

    // -------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // -------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------

    public function scopeForStatus(Builder $query, OrderStatus $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeB2b(Builder $query): Builder
    {
        return $query->where('is_b2b', true);
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    // -------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------

    public function getFormattedTotal(): string
    {
        return 'Rs. ' . number_format((float) $this->total, 2);
    }

    public static function generateOrderNumber(): string
    {
        return 'SB-' . strtoupper(uniqid());
    }
}
