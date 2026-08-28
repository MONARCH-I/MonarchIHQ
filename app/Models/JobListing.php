<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class JobListing extends Model
{
    protected $fillable = [
        'title',
        'department',
        'employment_type',
        'location',
        'skills_required',
        'description',
        'apply_email',
        'is_active',
        'sort_order',
        'created_by',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    public function employmentTypeLabel(): string
    {
        return match ($this->employment_type) {
            'full_time'  => 'Full-Time',
            'part_time'  => 'Part-Time',
            'contract'   => 'Contract',
            'internship' => 'Internship',
            default      => ucfirst($this->employment_type),
        };
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function creator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
