<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GiftBox extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'capacity_units',
        'price_tier1',
        'price_tier2',
        'price_tier3',
        'price_tier4',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'capacity_units' => 'decimal:1',
        'price_tier1'    => 'decimal:2',
        'price_tier2'    => 'decimal:2',
        'price_tier3'    => 'decimal:2',
        'price_tier4'    => 'decimal:2',
        'is_active'      => 'boolean',
        'sort_order'     => 'integer',
    ];

    // -------------------------------------------------------------------
    // Media Library
    // -------------------------------------------------------------------

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('box_images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->width(600)
            ->height(600)
            ->nonQueued();
    }

    // -------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------

    public function quoteRequests(): HasMany
    {
        return $this->hasMany(QuoteRequest::class);
    }

    // -------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    // -------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------

    public function getPriceForQuantity(int $quantity): float
    {
        return match (true) {
            $quantity >= 500 => (float) $this->price_tier4,
            $quantity >= 200 => (float) $this->price_tier3,
            $quantity >= 100 => (float) $this->price_tier2,
            default          => (float) $this->price_tier1,
        };
    }

    public function getTierLabel(int $quantity): string
    {
        return match (true) {
            $quantity >= 500 => '500+ pcs',
            $quantity >= 200 => '200-499 pcs',
            $quantity >= 100 => '100-199 pcs',
            default          => '50-99 pcs',
        };
    }

    public function getFormattedPriceForQuantity(int $quantity): string
    {
        return 'Rs. ' . number_format($this->getPriceForQuantity($quantity), 2);
    }
}
