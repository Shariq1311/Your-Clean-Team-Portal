<?php

namespace Mojahid\Ecommerce\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Models\User;

class VendorBalance extends Model
{
    protected $table = 'vendor_balances';
    
    protected $fillable = [
        'vendor_id',
        'balance',
        'total_earnings',
        'total_withdrawals',
        'pending_balance',
        'currency_code'
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'total_earnings' => 'decimal:2',
        'total_withdrawals' => 'decimal:2',
        'pending_balance' => 'decimal:2'
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    public function earnings(): HasMany
    {
        return $this->hasMany(VendorEarning::class, 'vendor_id', 'vendor_id');
    }

    public function withdrawals(): HasMany
    {
        return $this->hasMany(VendorWithdrawal::class, 'vendor_id', 'vendor_id');
    }

    public static function findOrCreateForVendor(int $vendorId, string $currencyCode = 'USD'): self
    {
        return static::firstOrCreate(
            ['vendor_id' => $vendorId, 'currency_code' => $currencyCode],
            [
                'balance' => 0,
                'total_earnings' => 0,
                'total_withdrawals' => 0,
                'pending_balance' => 0,
                'currency_code' => $currencyCode
            ]
        );
    }

    public function addEarning(float $amount): void
    {
        $this->increment('total_earnings', $amount);
        $this->increment('balance', $amount);
    }

    public function addPendingEarning(float $amount): void
    {
        $this->increment('pending_balance', $amount);
    }

    public function completePendingEarning(float $amount): void
    {
        $this->decrement('pending_balance', $amount);
        $this->increment('balance', $amount);
        $this->increment('total_earnings', $amount);
    }

    public function addWithdrawal(float $amount): void
    {
        $this->decrement('balance', $amount);
        $this->increment('total_withdrawals', $amount);
    }

    public function getAvailableBalance(): float
    {
        return (float) $this->balance;
    }

    public function getPendingBalance(): float
    {
        return (float) $this->pending_balance;
    }
}
