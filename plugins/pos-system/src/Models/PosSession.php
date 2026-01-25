<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MojarCMS\CMS\Models\User;
use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Traits\ResourceModel;
final class PosSession extends Model
{
    use ResourceModel;

    protected $table = 'pos_sessions';

    protected $fillable = [
        'user_id',
        'session_name',
        'opening_balance',
        'closing_balance',
        'expected_balance',
        'total_cash_sales',
        'total_card_sales',
        'total_digital_sales',
        'total_transactions',
        'status',
        'opened_at',
        'closed_at',
        'session_data',
        'notes',
    ];

    protected string $fieldName = 'session_name';

    protected $casts = [
        'opening_balance' => 'decimal:2',
        'closing_balance' => 'decimal:2',
        'expected_balance' => 'decimal:2',
        'total_cash_sales' => 'decimal:2',
        'total_card_sales' => 'decimal:2',
        'total_digital_sales' => 'decimal:2',
        'total_transactions' => 'integer',
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
        'session_data' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(PosOrder::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(PosCart::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isClosed(): bool
    {
        return $this->status === 'closed';
    }

    public function getTotalSales(): float
    {
        return (float) ($this->total_cash_sales + $this->total_card_sales + $this->total_digital_sales);
    }

    public function getExpectedCashBalance(): float
    {
        return (float) ($this->opening_balance + $this->total_cash_sales);
    }

    public function getCashDifference(): float
    {
        if (!$this->closing_balance) {
            return 0;
        }
        
        return (float) ($this->closing_balance - $this->getExpectedCashBalance());
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }
} 