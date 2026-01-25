<?php

namespace Mojahid\Ecommerce\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Models\User;

class VendorEarning extends Model
{
    protected $table = 'vendor_earnings';
    
    protected $fillable = [
        'vendor_id',
        'order_id',
        'order_item_id',
        'order_amount',
        'commission_rate',
        'commission_amount',
        'vendor_amount',
        'currency_code',
        'status',
        'paid_at'
    ];

    protected $casts = [
        'order_amount' => 'decimal:2',
        'commission_rate' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'vendor_amount' => 'decimal:2',
        'paid_at' => 'datetime'
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id', 'id');
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function markAsCompleted(): void
    {
        $this->update([
            'status' => self::STATUS_COMPLETED,
            'paid_at' => now()
        ]);
    }

    public function markAsCancelled(): void
    {
        $this->update([
            'status' => self::STATUS_CANCELLED
        ]);
    }

    public static function createFromOrderItem(OrderItem $orderItem, float $commissionRate): self
    {
        $post = $orderItem->post;
        $vendorId = $post->getMeta('vendor_id');
        
        if (!$vendorId) {
            throw new \Exception('Product has no vendor assigned');
        }

        $orderAmount = (float) $orderItem->line_price;
        $commissionAmount = $orderAmount * ($commissionRate / 100);
        $vendorAmount = $orderAmount - $commissionAmount;

        return static::create([
            'vendor_id' => $vendorId,
            'order_id' => $orderItem->order_id,
            'order_item_id' => $orderItem->id,
            'order_amount' => $orderAmount,
            'commission_rate' => $commissionRate,
            'commission_amount' => $commissionAmount,
            'vendor_amount' => $vendorAmount,
            'currency_code' => 'USD', // TODO: Get from order
            'status' => self::STATUS_PENDING
        ]);
    }
}
