<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PortfolioProject extends Model
{
    protected $table = 'portfolio_projects';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'tech_stack',
        'domain',
        'sub_domain',
        'status',
        'status_color',
        'metric_label',
        'metric_value',
        'is_published',
        'sort_order',
        'created_by',
    ];

    protected $casts = [
        'tech_stack'   => 'array',
        'is_published' => 'boolean',
        'sort_order'   => 'integer',
    ];

    public function statusBadgeClass(): string
    {
        return match ($this->status_color) {
            'green'  => 'bg-green-500/10 text-green-500 border-green-500/20',
            'amber'  => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
            'purple' => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
            default  => 'bg-blue-500/10 text-[#2997ff] border-blue-500/20',
        };
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)->orderBy('sort_order');
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function creator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ─── Auto-slug ───────────────────────────────────────────────────────────

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (self $project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }
}
