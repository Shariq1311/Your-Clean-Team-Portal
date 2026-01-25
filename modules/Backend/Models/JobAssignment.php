<?php

namespace MojarCMS\Backend\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Models\User;

class JobAssignment extends Model
{
    protected $table = 'job_assignments';

    protected $fillable = [
        'user_id',
        'schedule_id',
        'status',
        'completion_notes',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    /**
     * Get the employee assigned to this job
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the schedule for this job assignment
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }
}
