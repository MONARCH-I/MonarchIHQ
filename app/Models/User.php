<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'provider',
        'provider_id',
        'provider_token',
        'is_super_admin',
        'role',
        // Notification prefs
        'notif_orders',
        'notif_promos',
        'notif_blog',
        'notif_security',
        // Display
        'language',
        'currency',
        // Shipping
        'address_street',
        'address_city',
        'address_region',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_super_admin' => 'boolean',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_super_admin || $this->hasManagerAccess();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // ─── ABAC Role Helpers ────────────────────────────────────────────────────

    /** Super admin — full access everywhere */
    public function isSuperAdmin(): bool
    {
        return $this->is_super_admin || $this->role === 'super_admin';
    }

    public function isContentManager(): bool
    {
        return $this->isSuperAdmin() || $this->role === 'content_manager';
    }

    public function isStoreManager(): bool
    {
        return $this->isSuperAdmin() || $this->role === 'store_manager';
    }

    /** HR manager — can also manage employees and view company analytics */
    public function isHrManager(): bool
    {
        return $this->isSuperAdmin() || $this->role === 'hr_manager';
    }

    /** Any manager-level access */
    public function hasManagerAccess(): bool
    {
        return $this->isSuperAdmin()
            || in_array($this->role, ['content_manager', 'store_manager', 'hr_manager']);
    }

    /**
     * Super admin and HR can add/manage employees and view analytics/reports.
     * Backups are restricted to super_admin only (checked via isSuperAdmin()).
     */
    public function canManageEmployees(): bool
    {
        return $this->isSuperAdmin() || $this->role === 'hr_manager';
    }

    /** Human-readable role label */
    public function roleLabel(): string
    {
        return match ($this->role) {
            'super_admin' => 'Super Admin',
            'content_manager' => 'Content Manager',
            'store_manager' => 'Store Manager',
            'hr_manager' => 'HR Manager',
            default => 'Member',
        };
    }
}
