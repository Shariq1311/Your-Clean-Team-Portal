<?php

namespace Mojahid\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShippingMethod extends Model
{
    protected $table = 'shipping_methods';

    protected $fillable = [
        'name',
        'description',
        'cost',
        'min_weight',
        'max_weight',
        'min_order_value',
        'is_active',
        'delivery_time',
        'provinces',
        'countries'
    ];

    protected $casts = [
        'cost' => 'decimal:2',
        'min_weight' => 'decimal:2',
        'max_weight' => 'decimal:2',
        'min_order_value' => 'decimal:2',
        'is_active' => 'boolean',
        'provinces' => 'array',
        'countries' => 'array'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function shippingAddresses(): HasMany
    {
        return $this->hasMany(ShippingAddress::class);
    }

    public function calculateShipping(float $orderValue, float $weight = 0, string $province = null): float
    {
        if (!$this->is_active) {
            return 0;
        }

        if ($this->min_order_value > 0 && $orderValue < $this->min_order_value) {
            return 0;
        }

        if ($this->min_weight > 0 && $weight < $this->min_weight) {
            return 0;
        }

        if ($this->max_weight > 0 && $weight > $this->max_weight) {
            return 0;
        }

        if (!empty($this->provinces) && $province && !in_array($province, $this->provinces)) {
            return 0;
        }

        return (float) $this->cost;
    }

    public function isAvailableFor(float $orderValue, float $weight = 0, string $province = null): bool
    {
        return $this->calculateShipping($orderValue, $weight, $province) >= 0;
    }
} 