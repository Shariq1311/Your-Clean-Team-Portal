<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MojarCMS\Backend\Models\Post;
use MojarCMS\CMS\Models\Model;

final class PosOrderItem extends Model
{
    protected $table = 'pos_order_items';

    protected $fillable = [
        'pos_order_id',
        'post_id',
        'product_name',
        'product_sku',
        'product_price',
        'quantity',
        'subtotal',
        'discount_amount',
        'tax_amount',
        'total_amount',
        'product_data',
        'notes',
    ];

    protected $casts = [
        'product_price' => 'decimal:2',
        'quantity' => 'integer',
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'product_data' => 'array',
    ];

    public function posOrder(): BelongsTo
    {
        return $this->belongsTo(PosOrder::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function getUnitPrice(): float
    {
        return (float) $this->product_price;
    }

    public function getLineTotal(): float
    {
        return (float) $this->total_amount;
    }

    public function getDiscountedPrice(): float
    {
        return (float) ($this->product_price - ($this->discount_amount / $this->quantity));
    }

    public function hasDiscount(): bool
    {
        return $this->discount_amount > 0;
    }

    public function getFormattedPrice(): string
    {
        return pos_format_price($this->product_price);
    }

    public function getFormattedTotal(): string
    {
        return pos_format_price($this->total_amount);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Calculate subtotal
            $model->subtotal = $model->product_price * $model->quantity;
            
            // Calculate total (subtotal - discount + tax)
            $model->total_amount = $model->subtotal - $model->discount_amount + $model->tax_amount;
        });
    }
} 