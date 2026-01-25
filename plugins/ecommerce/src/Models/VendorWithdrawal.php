<?php

namespace Mojahid\Ecommerce\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Models\User;

class VendorWithdrawal extends Model
{
    protected $table = 'vendor_withdrawals';
    
    protected $fillable = [
        'vendor_id',
        'amount',
        'currency_code',
        'status',
        'payment_method',
        'payment_details',
        'notes',
        'processed_at',
        'processed_by'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_details' => 'array',
        'processed_at' => 'datetime'
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_COMPLETED = 'completed';

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by', 'id');
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function approve(int $processedBy): void
    {
        $this->update([
            'status' => self::STATUS_APPROVED,
            'processed_by' => $processedBy,
            'processed_at' => now()
        ]);
    }

    public function reject(int $processedBy, string $notes = null): void
    {
        $this->update([
            'status' => self::STATUS_REJECTED,
            'processed_by' => $processedBy,
            'processed_at' => now(),
            'notes' => $notes
        ]);
    }

    public function complete(int $processedBy): void
    {
        $this->update([
            'status' => self::STATUS_COMPLETED,
            'processed_by' => $processedBy,
            'processed_at' => now()
        ]);
    }

    public function getStatusTextAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => trans('ecomm::content.pending'),
            self::STATUS_APPROVED => trans('ecomm::content.approved'),
            self::STATUS_REJECTED => trans('ecomm::content.rejected'),
            self::STATUS_COMPLETED => trans('ecomm::content.completed'),
            default => trans('ecomm::content.unknown')
        };
    }
}
