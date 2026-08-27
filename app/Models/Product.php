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

    /**
     * Compute the single active badge for this product.
     * Guaranteed never duplicated. Priority:
     * 1. Out of stock / Restock soon (grayed out)
     * 2. Admin explicit badge (Pre-Order, Limited Offer, or custom text)
     * 3. System automated badge (Limited Quantity, Limited Offer / Sale, Popular)
     *
     * @return array{text: string, color: string, is_grayed: bool}|null
     */
    public function getBadgeAttribute(): ?array
    {
        // 1. Out of stock (Grayed out)
        if ($this->stock_quantity <= 0) {
            return [
                'text'      => 'Restock Soon',
                'color'     => 'gray',
                'is_grayed' => true,
            ];
        }

        // 2. Admin explicitly set badge
        if (!empty($this->badge_text)) {
            $normalized = strtolower(trim($this->badge_text));
            $color = $this->badge_color ?: 'orange';
            $text  = $this->badge_text;

            if (str_contains($normalized, 'pre order') || str_contains($normalized, 'pre-order')) {
                $text = 'Pre-Order';
                $color = 'orange';
            } elseif (str_contains($normalized, 'limited offer') || str_contains($normalized, 'sale')) {
                $text = 'Limited Offer';
                $color = 'red';
            }

            return [
                'text'      => $text,
                'color'     => $color,
                'is_grayed' => false,
            ];
        }

        // 3. System automated badges
        if ($this->stock_quantity <= $this->min_stock_threshold) {
            return [
                'text'      => 'Limited Quantity',
                'color'     => 'orange',
                'is_grayed' => false,
            ];
        }

        if ($this->is_on_sale) {
            return [
                'text'      => 'Limited Offer',
                'color'     => 'red',
                'is_grayed' => false,
            ];
        }

        if ($this->is_featured) {
            return [
                'text'      => 'Popular',
                'color'     => 'blue',
                'is_grayed' => false,
            ];
        }

        return null;
    }
}
