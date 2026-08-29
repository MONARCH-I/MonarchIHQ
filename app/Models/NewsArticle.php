<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class NewsArticle extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'category',
        'cover_image',
        'author_name',
        'read_time_minutes',
        'is_published',
        'published_at',
        'created_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Category constants
    const CATEGORY_AFRICAN_TECH = 'african_tech';

    const CATEGORY_GLOBAL_TECH = 'global_tech';

    const CATEGORY_ENGINEERING = 'engineering';

    public static function getCategoryLabel(string $category): string
    {
        return match ($category) {
            self::CATEGORY_AFRICAN_TECH => 'African Tech',
            self::CATEGORY_GLOBAL_TECH => 'Global Tech',
            self::CATEGORY_ENGINEERING => 'Engineering',
            default => ucfirst($category),
        };
    }

    public function categoryLabel(): string
    {
        return self::getCategoryLabel($this->category);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ─── Slug auto-generation ─────────────────────────────────────────────────

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (self $article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }
}
