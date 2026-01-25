<?php

namespace Mojahid\Ecommerce\Models;

use MojarCMS\CMS\Models\Model;

class Currency extends Model
{
    protected $table = 'ecomm_currencies';
    
    protected $fillable = [
        'code',
        'symbol',
        'exchange_rate',
        'is_default',
        'is_enabled',
        'name',
        'symbol_position',
        'thousand_separator',
        'decimal_separator',
        'decimal_place',
        'decimal_point',
        'currency_format',
        'custom_price_format',
    ];

    protected $casts = [
        'exchange_rate' => 'float',
        'is_default' => 'boolean',
        'is_enabled' => 'boolean',
        'decimal_place' => 'integer',
    ];

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    public function scopeEnabled($query)
    {
        return $query->where('is_enabled', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_enabled', true);
    }

    /**
     * Get the formatted price for this currency
     */
    public function formatPrice(float $amount): string
    {
        $symbol = $this->symbol ?: '$';
        $decPlace = $this->decimal_place ?? 2;
        $decSep = $this->decimal_separator ?? '.';
        $thouSep = $this->thousand_separator ?? ',';

        $formattedValue = number_format($amount, $decPlace, $decSep, $thouSep);

        // Check custom format
        if (!empty($this->custom_price_format)) {
            return str_replace(
                ['{symbol}', '{amount}', '{code}'],
                [$symbol, $formattedValue, $this->code],
                $this->custom_price_format
            );
        }

        // Default formatting based on symbol position
        if ($this->symbol_position === 'after') {
            return $formattedValue . ' ' . $symbol;
        }
        
        return $symbol . $formattedValue;
    }

    /**
     * Convert amount from base currency to this currency
     */
    public function convertFromBase(float $baseAmount): float
    {
        return $baseAmount * $this->exchange_rate;
    }

    /**
     * Convert amount from this currency to base currency
     */
    public function convertToBase(float $amount): float
    {
        return $amount / $this->exchange_rate;
    }

    /**
     * Get display name for the currency
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name ?: $this->code;
    }

    /**
     * Get full display name with code
     */
    public function getFullDisplayNameAttribute(): string
    {
        return $this->name ? "{$this->name} ({$this->code})" : $this->code;
    }
}
