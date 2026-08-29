<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'status',
        'payment_status',
        'payment_method',
        'payment_reference',
        'payment_channel',
        'paid_at',
        'paystack_response',
        'currency',
        'subtotal',
        'shipping',
        'total',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
        'paystack_response' => 'array',
    ];

    const STATUSES = [
        'pending' => 'Pending',
        'processing' => 'Processing',
        'shipped' => 'Shipped',
        'delivered' => 'Delivered',
        'cancelled' => 'Cancelled',
    ];

    const PAYMENT_STATUSES = [
        'pending' => 'Pending',
        'paid' => 'Paid',
        'failed' => 'Failed',
        'refunded' => 'Refunded',
    ];

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function markAsPaid(?string $channel = null, ?array $response = null): self
    {
        $this->update([
            'payment_status' => 'paid',
            'status' => 'processing',
            'payment_channel' => $channel ?? $this->payment_channel,
            'paid_at' => now(),
            'paystack_response' => $response ?? $this->paystack_response,
        ]);

        return $this;
    }

    public function markAsFailed(?array $response = null): self
    {
        $this->update([
            'payment_status' => 'failed',
            'paystack_response' => $response ?? $this->paystack_response,
        ]);

        return $this;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
