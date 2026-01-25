<?php

namespace MojarCMS\Backend\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Models\User;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $fillable = [
        'user_id',
        'scheduled_date',
        'start_time',
        'end_time',
        'location_id',
        'service_id',
        'status',
        'notes',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    /**
     * Get the user assigned to this schedule
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the location for this schedule
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the service for this schedule
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get all job assignments for this schedule
     */
    public function jobAssignments(): HasMany
    {
        return $this->hasMany(JobAssignment::class);
    }
}
