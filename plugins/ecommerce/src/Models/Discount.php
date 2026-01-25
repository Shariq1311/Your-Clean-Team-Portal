<?php

namespace Mojahid\Ecommerce\Models;

use MojarCMS\CMS\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use MojarCMS\Backend\Models\Post;
use MojarCMS\Backend\Models\Taxonomy;
use Carbon\Carbon;

class Discount extends Model
{
    protected $table = 'ecomm_discounts';
    
    protected $fillable = [
        'title',
        'code',
        'description',
        'type',
        'value',
        'minimum_amount',
        'maximum_discount',
        'usage_limit',
        'usage_limit_per_customer',
        'used_count',
        'is_active',
        'free_shipping',
        'start_date',
        'end_date',
        'applicable_products',
        'applicable_categories',
        'excluded_products',
        'excluded_categories',
        'site_id'
    ];

    protected $casts = [
        'value' => 'float',
        'minimum_amount' => 'float',
        'maximum_discount' => 'float',
        'used_count' => 'integer',
        'usage_limit' => 'integer',
        'usage_limit_per_customer' => 'integer',
        'is_active' => 'boolean',
        'free_shipping' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'applicable_products' => 'array',
        'applicable_categories' => 'array',
        'excluded_products' => 'array',
        'excluded_categories' => 'array',
        'site_id' => 'integer'
    ];

    protected $attributes = [
        'site_id' => 0,
        'used_count' => 0,
        'is_active' => true,
        'free_shipping' => false,
        'type' => 'percentage'
    ];

    public const TYPE_PERCENTAGE = 'percentage';
    public const TYPE_FIXED = 'fixed';

    public static function getTypes(): array
    {
        return [
            self::TYPE_PERCENTAGE => 'Percentage',
            self::TYPE_FIXED => 'Fixed Amount'
        ];
    }

    public function isValid(float $cartTotal = 0, array $cartItems = [], int $userId = null): bool
    {
        // Check if discount is active
        if (!$this->is_active) {
            return false;
        }

        // Check date validity
        $now = Carbon::now();
        if ($this->start_date && $now->lt($this->start_date)) {
            return false;
        }
        if ($this->end_date && $now->gt($this->end_date)) {
            return false;
        }

        // Check minimum amount
        if ($this->minimum_amount > 0 && $cartTotal < $this->minimum_amount) {
            return false;
        }

        // Check usage limit
        if ($this->usage_limit > 0 && $this->used_count >= $this->usage_limit) {
            return false;
        }

        // Check per customer usage limit
        if ($userId && $this->usage_limit_per_customer > 0) {
            $customerUsage = $this->getCustomerUsageCount($userId);
            if ($customerUsage >= $this->usage_limit_per_customer) {
                return false;
            }
        }

        // Check product/category restrictions
        if (!$this->isApplicableToCart($cartItems)) {
            return false;
        }

        return true;
    }

    public function calculateDiscount(float $cartTotal, array $cartItems = []): float
    {
        if (!$this->isValid($cartTotal, $cartItems)) {
            return 0;
        }

        $discount = 0;

        if ($this->type === self::TYPE_PERCENTAGE) {
            $discount = ($cartTotal * $this->value) / 100;
        } else {
            $discount = $this->value;
        }

        // Apply maximum discount limit
        if ($this->maximum_discount > 0 && $discount > $this->maximum_discount) {
            $discount = $this->maximum_discount;
        }

        // Ensure discount doesn't exceed cart total
        if ($discount > $cartTotal) {
            $discount = $cartTotal;
        }

        return round($discount, 2);
    }

    public function isApplicableToCart(array $cartItems): bool
    {
        if (empty($cartItems)) {
            return true;
        }

        $productIds = collect($cartItems)->pluck('post_id')->toArray();
        
        // If specific products are set, check if any cart items match
        if (!empty($this->applicable_products)) {
            $hasApplicableProduct = !empty(array_intersect($productIds, $this->applicable_products));
            if (!$hasApplicableProduct) {
                return false;
            }
        }

        // If excluded products are set, check if any cart items are excluded
        if (!empty($this->excluded_products)) {
            $hasExcludedProduct = !empty(array_intersect($productIds, $this->excluded_products));
            if ($hasExcludedProduct) {
                return false;
            }
        }

        // Check categories if specified
        if (!empty($this->applicable_categories) || !empty($this->excluded_categories)) {
            $cartCategories = $this->getCartCategories($productIds);
            
            if (!empty($this->applicable_categories)) {
                $hasApplicableCategory = !empty(array_intersect($cartCategories, $this->applicable_categories));
                if (!$hasApplicableCategory) {
                    return false;
                }
            }

            if (!empty($this->excluded_categories)) {
                $hasExcludedCategory = !empty(array_intersect($cartCategories, $this->excluded_categories));
                if ($hasExcludedCategory) {
                    return false;
                }
            }
        }

        return true;
    }

    protected function getCartCategories(array $productIds): array
    {
        if (empty($productIds)) {
            return [];
        }

        return Post::whereIn('id', $productIds)
            ->with('taxonomies')
            ->get()
            ->pluck('taxonomies')
            ->flatten()
            ->where('taxonomy', 'categories')
            ->pluck('id')
            ->unique()
            ->toArray();
    }

    public function getCustomerUsageCount(int $userId): int
    {
        // This would need to be implemented based on order history
        // For now, return 0 as placeholder
        return 0;
    }

    public function incrementUsage(): void
    {
        $this->increment('used_count');
    }

    public function getFormattedValue(): string
    {
        if ($this->type === self::TYPE_PERCENTAGE) {
            return $this->value . '%';
        }
        
        return ecom_price_with_unit($this->value);
    }

    public function getStatusBadge(): string
    {
        if (!$this->is_active) {
            return '<span class="badge bg-danger">Inactive</span>';
        }

        $now = Carbon::now();
        if ($this->start_date && $now->lt($this->start_date)) {
            return '<span class="badge bg-warning">Scheduled</span>';
        }
        
        if ($this->end_date && $now->gt($this->end_date)) {
            return '<span class="badge bg-danger">Expired</span>';
        }

        if ($this->usage_limit > 0 && $this->used_count >= $this->usage_limit) {
            return '<span class="badge bg-danger">Limit Reached</span>';
        }

        return '<span class="badge bg-success">Active</span>';
    }

    public static function findByCode(string $code): ?self
    {
        return static::where('code', $code)->where('is_active', true)->first();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeValid($query)
    {
        $now = Carbon::now();
        return $query->where('is_active', true)
            ->where(function($q) use ($now) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
            })
            ->where(function($q) use ($now) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
            });
    }
} 