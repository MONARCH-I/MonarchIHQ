<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
        'hr_notes',
        'replied_at',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    // Status constants
    const STATUS_NEW         = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_REPLIED     = 'replied';
    const STATUS_CLOSED      = 'closed';

    public function statusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_NEW         => 'New',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_REPLIED     => 'Replied',
            self::STATUS_CLOSED      => 'Closed',
            default                  => ucfirst($this->status),
        };
    }

    public function statusBadgeClass(): string
    {
        return match ($this->status) {
            self::STATUS_NEW         => 'bg-blue-500/10 text-[#2997ff] border-blue-500/20',
            self::STATUS_IN_PROGRESS => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
            self::STATUS_REPLIED     => 'bg-green-500/10 text-green-500 border-green-500/20',
            self::STATUS_CLOSED      => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
            default                  => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
        };
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeNew(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_NEW);
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->whereIn('status', [self::STATUS_NEW, self::STATUS_IN_PROGRESS]);
    }
}
