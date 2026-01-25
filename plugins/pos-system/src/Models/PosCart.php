<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MojarCMS\CMS\Models\User;
use MojarCMS\CMS\Models\Model;

final class PosCart extends Model
{
    protected $table = 'pos_carts';

    protected $fillable = [
        'cart_token',
        'user_id',
        'pos_session_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'items',
        'discounts',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'total_amount',
        'status',
    ];

    protected $casts = [
        'items' => 'array',
        'discounts' => 'array',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_CONVERTED = 'converted';
    const STATUS_ABANDONED = 'abandoned';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function posSession(): BelongsTo
    {
        return $this->belongsTo(PosSession::class);
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isConverted(): bool
    {
        return $this->status === self::STATUS_CONVERTED;
    }

    public function isAbandoned(): bool
    {
        return $this->status === self::STATUS_ABANDONED;
    }

    public function isEmpty(): bool
    {
        return empty($this->items) || count($this->items) === 0;
    }

    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    public function getTotalQuantity(): int
    {
        if ($this->isEmpty()) {
            return 0;
        }

        return array_sum(array_column($this->items, 'quantity'));
    }

    public function getTotalItems(): int
    {
        return count($this->items ?? []);
    }

    public function hasCustomer(): bool
    {
        return !empty($this->customer_name) && $this->customer_name !== pos_get_default_customer();
    }

    public function getFormattedTotal(): string
    {
        return pos_format_price($this->total_amount);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByToken($query, string $token)
    {
        return $query->where('cart_token', $token);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->cart_token)) {
                $model->cart_token = static::generateCartToken();
            }
        });
    }

    public static function generateCartToken(): string
    {
        return 'pos_cart_' . uniqid() . '_' . time();
    }
} 