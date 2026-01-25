<?php

namespace Mojahid\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingAddress extends Model
{
    protected $table = 'shipping_address';

    protected $fillable = [
        'full_name',
        'phone',
        'address',
        'province',
        'country_code',
        'address_id',
        'order_id',
        'shop_id'
    ];

    protected $casts = [
        'order_id' => 'integer',
        'address_id' => 'integer',
        'shop_id' => 'integer'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function shippingMethod(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([
            $this->address,
            $this->province,
            $this->country_code
        ]);

        return implode(', ', $parts);
    }
} 