<?php

namespace MojarCMS\Backend\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Models\User;

class TimeLog extends Model
{
    protected $table = 'time_logs';

    protected $fillable = [
        'user_id',
        'clock_in',
        'clock_out',
        'hours_worked',
        'notes',
        'status',
        'location_ip',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'clock_in' => 'datetime',
        'clock_out' => 'datetime',
        'hours_worked' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Get the user that owns the time log
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate hours worked
     */
    public function calculateHours(): float
    {
        if ($this->clock_in && $this->clock_out) {
            return round($this->clock_out->diffInMinutes($this->clock_in) / 60, 2);
        }
        return 0;
    }
}
