<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model implements HasMedia
{
    use HasSlug;
    use InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'sku',
        'price',
        'b2b_price',
        'min_b2b_quantity',
        'stock_quantity',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'price'            => 'decimal:2',
        'b2b_price'        => 'decimal:2',
        'min_b2b_quantity' => 'integer',
        'stock_quantity'   => 'integer',
        'is_active'        => 'boolean',
        'is_featured'      => 'boolean',
    ];

    // -------------------------------------------------------------------
    // Sluggable
    // -------------------------------------------------------------------

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // -------------------------------------------------------------------
    // Media Library
    // -------------------------------------------------------------------

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(400)
            ->nonQueued();

        $this->addMediaConversion('card')
            ->width(800)
            ->height(800)
            ->nonQueued();
    }

    // -------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    // -------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('stock_quantity', '>', 0);
    }

    public function scopeB2b(Builder $query): Builder
    {
        return $query->whereNotNull('b2b_price');
    }

    // -------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------

    public function getPriceForUser(?User $user = null): string
    {
        if ($user && $user->is_b2b && $user->is_verified && $this->b2b_price !== null) {
            return $this->b2b_price;
        }

        return $this->price;
    }

    public function isInStock(): bool
    {
        return $this->stock_quantity > 0;
    }

    public function getFormattedPrice(): string
    {
        return 'Rs. ' . number_format((float) $this->price, 2);
    }

    public function getFormattedB2bPrice(): ?string
    {
        if ($this->b2b_price === null) {
            return null;
        }

        return 'Rs. ' . number_format((float) $this->b2b_price, 2);
    }
}
