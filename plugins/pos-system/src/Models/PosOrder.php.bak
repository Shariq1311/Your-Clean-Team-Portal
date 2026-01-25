<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MojarCMS\CMS\Models\User;
use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Traits\ResourceModel;

final class PosOrder extends Model
{
    use ResourceModel;

    protected $table = 'pos_orders';

    protected $fillable = [
        'order_number',
        'user_id',
        'pos_session_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'total_amount',
        'paid_amount',
        'change_amount',
        'payment_method',
        'status',
        'notes',
        'order_data',
        'completed_at',
    ];

    protected string $fieldName = 'order_number';

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'change_amount' => 'decimal:2',
        'completed_at' => 'datetime',
        'order_data' => 'array',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_HOLD = 'hold';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_REFUNDED = 'refunded';

    const PAYMENT_CASH = 'cash';
    const PAYMENT_CARD = 'card';
    const PAYMENT_DIGITAL = 'digital';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function posSession(): BelongsTo
    {
        return $this->belongsTo(PosSession::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(PosOrderItem::class);
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isHold(): bool
    {
        return $this->status === self::STATUS_HOLD;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function isRefunded(): bool
    {
        return $this->status === self::STATUS_REFUNDED;
    }

    public function isCashPayment(): bool
    {
        return $this->payment_method === self::PAYMENT_CASH;
    }

    public function isCardPayment(): bool
    {
        return $this->payment_method === self::PAYMENT_CARD;
    }

    public function isDigitalPayment(): bool
    {
        return $this->payment_method === self::PAYMENT_DIGITAL;
    }

    public function getTotalQuantity(): int
    {
        return $this->orderItems()->sum('quantity');
    }

    public function getStatusBadge(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => '<span class="badge badge-warning">Pending</span>',
            self::STATUS_COMPLETED => '<span class="badge badge-success">Completed</span>',
            self::STATUS_HOLD => '<span class="badge badge-info">Hold</span>',
            self::STATUS_CANCELLED => '<span class="badge badge-danger">Cancelled</span>',
            self::STATUS_REFUNDED => '<span class="badge badge-secondary">Refunded</span>',
            default => '<span class="badge badge-light">' . ucfirst($this->status) . '</span>',
        };
    }

    public function getPaymentMethodBadge(): string
    {
        return match ($this->payment_method) {
            self::PAYMENT_CASH => '<span class="badge badge-success">Cash</span>',
            self::PAYMENT_CARD => '<span class="badge badge-primary">Card</span>',
            self::PAYMENT_DIGITAL => '<span class="badge badge-info">Digital</span>',
            default => '<span class="badge badge-light">' . ucfirst($this->payment_method) . '</span>',
        };
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeHold($query)
    {
        return $query->where('status', self::STATUS_HOLD);
    }

    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForSession($query, int $sessionId)
    {
        return $query->where('pos_session_id', $sessionId);
    }

    public function scopeByPaymentMethod($query, string $paymentMethod)
    {
        return $query->where('payment_method', $paymentMethod);
    }
} 