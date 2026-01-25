<?php

namespace MojarCMS\Backend\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use MojarCMS\CMS\Models\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'zip_code',
        'latitude',
        'longitude',
        'contact_name',
        'contact_phone',
        'contact_email',
        'location_type',
        'notes',
        'status',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Get all schedules for this location
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get the full address as a string
     */
    public function getFullAddressAttribute(): string
    {
        $parts = [$this->address, $this->city];
        if ($this->state) {
            $parts[] = $this->state;
        }
        $parts[] = $this->zip_code;
        return implode(', ', array_filter($parts));
    }
}
