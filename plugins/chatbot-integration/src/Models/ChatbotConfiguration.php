<?php

declare(strict_types=1);

namespace Mojahid\ChatbotIntegration\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class ChatbotConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'config',
        'capabilities',
        'is_active',
        'sort_order',
        'status',
        'last_tested_at',
        'last_error',
        'metadata',
    ];

    protected $casts = [
        'config' => 'array',
        'capabilities' => 'array',
        'metadata' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'last_tested_at' => 'datetime',
    ];

    /**
     * Get all logs for this chatbot configuration
     */
    public function logs(): HasMany
    {
        return $this->hasMany(ChatbotLog::class, 'provider', 'name');
    }

    /**
     * Scope active configurations
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope ordered configurations
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('display_name');
    }

    /**
     * Get config value by key
     */
    public function getConfigValue(string $key, mixed $default = null): mixed
    {
        return data_get($this->config, $key, $default);
    }

    /**
     * Set config value by key
     */
    public function setConfigValue(string $key, mixed $value): self
    {
        $config = $this->config ?? [];
        data_set($config, $key, $value);
        $this->config = $config;
        return $this;
    }

    /**
     * Check if the configuration has a specific capability
     */
    public function hasCapability(string $capability): bool
    {
        return data_get($this->capabilities, $capability, false);
    }

    /**
     * Mark configuration as tested
     */
    public function markAsTested(bool $success = true, ?string $error = null): self
    {
        $this->last_tested_at = now();
        $this->status = $success ? 'active' : 'error';
        $this->last_error = $error;
        
        return $this;
    }

    /**
     * Check if configuration is ready for use
     */
    public function isReady(): bool
    {
        return $this->is_active && $this->status === 'active' && !empty($this->config);
    }

    /**
     * Get display status attribute
     */
    protected function displayStatus(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'active' => $this->is_active ? 'Active' : 'Inactive',
                'error' => 'Error',
                'inactive' => 'Inactive',
                default => 'Unknown',
            }
        );
    }

    /**
     * Get status color attribute
     */
    protected function statusColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'active' => $this->is_active ? 'success' : 'secondary',
                'error' => 'danger',
                'inactive' => 'secondary',
                default => 'secondary',
            }
        );
    }
}