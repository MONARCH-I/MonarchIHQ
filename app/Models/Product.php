<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'description',
        'short_description',
        'price',
        'sale_price',
        'stock_quantity',
        'min_stock_threshold',
        'is_featured',
        'is_active',
        'badge_text',
        'badge_color',
        'card_style',
        'image_path',
        'gallery',
    ];

    protected $casts = [
        'price'              => 'decimal:2',
        'sale_price'         => 'decimal:2',
        'is_featured'        => 'boolean',
        'is_active'          => 'boolean',
        'gallery'            => 'array',
    ];

    // ── Relationships ─────────────────────────────────────────────────────────

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // ── Scopes ────────────────────────────────────────────────────────────────

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }

    public function scopeLowStock(Builder $query): Builder
    {
        return $query->whereColumn('stock_quantity', '<=', 'min_stock_threshold')
                     ->where('stock_quantity', '>', 0);
    }

    public function scopeOutOfStock(Builder $query): Builder
    {
        return $query->where('stock_quantity', 0);
    }

    public function scopeForCategory(Builder $query, string $categorySlug): Builder
    {
        return $query->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
    }

    // ── Computed Properties ───────────────────────────────────────────────────

    public function getDisplayPriceAttribute(): string
    {
        $price = $this->sale_price ?? $this->price;
        return '₵' . number_format($price, 2);
    }

    public function getOriginalPriceAttribute(): ?string
    {
        return $this->sale_price
            ? '₵' . number_format($this->price, 2)
            : null;
    }

    public function getStockStatusAttribute(): string
    {
        if ($this->stock_quantity === 0) return 'out_of_stock';
        if ($this->stock_quantity <= $this->min_stock_threshold) return 'low_stock';
        return 'in_stock';
    }

    public function getIsOnSaleAttribute(): bool
    {
        return $this->sale_price !== null && $this->sale_price < $this->price;
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image_path) {
            return 'https://placehold.co/400x400/1a1a1a/ffffff?text=' . urlencode($this->name);
        }
        return asset('storage/' . $this->image_path);
    }
}
