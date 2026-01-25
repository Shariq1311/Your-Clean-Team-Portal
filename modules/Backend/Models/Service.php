<?php

namespace MojarCMS\Backend\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use MojarCMS\CMS\Models\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'name',
        'description',
        'type',
        'base_price',
        'duration',
        'status',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
    ];

    /**
     * Get all schedules for this service
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
