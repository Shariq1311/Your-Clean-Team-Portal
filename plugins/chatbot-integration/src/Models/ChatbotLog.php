<?php

declare(strict_types=1);

namespace Mojahid\ChatbotIntegration\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class ChatbotLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider',
        'event_type',
        'level',
        'message',
        'payload',
        'context',
        'user_id',
        'session_id',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'payload' => 'array',
        'context' => 'array',
    ];

    /**
     * Get the configuration this log belongs to
     */
    public function configuration(): BelongsTo
    {
        return $this->belongsTo(ChatbotConfiguration::class, 'provider', 'name');
    }

    /**
     * Scope by provider
     */
    public function scopeByProvider($query, string $provider)
    {
        return $query->where('provider', $provider);
    }

    /**
     * Scope by level
     */
    public function scopeByLevel($query, string $level)
    {
        return $query->where('level', $level);
    }

    /**
     * Scope by event type
     */
    public function scopeByEventType($query, string $eventType)
    {
        return $query->where('event_type', $eventType);
    }

    /**
     * Scope recent logs
     */
    public function scopeRecent($query, int $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope errors only
     */
    public function scopeErrors($query)
    {
        return $query->where('level', 'error');
    }

    /**
     * Create a new log entry
     */
    public static function createLog(
        string $provider,
        string $eventType,
        string $message,
        string $level = 'info',
        ?array $payload = null,
        ?array $context = null
    ): self {
        return static::create([
            'provider' => $provider,
            'event_type' => $eventType,
            'level' => $level,
            'message' => $message,
            'payload' => $payload,
            'context' => $context,
            'user_id' => auth()->id(),
            'session_id' => session()->getId(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Get level badge color
     */
    public function getLevelColorAttribute(): string
    {
        return match ($this->level) {
            'debug' => 'secondary',
            'info' => 'primary',
            'warning' => 'warning',
            'error' => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Get formatted payload
     */
    public function getFormattedPayloadAttribute(): ?string
    {
        if (empty($this->payload)) {
            return null;
        }

        return json_encode($this->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Get formatted context
     */
    public function getFormattedContextAttribute(): ?string
    {
        if (empty($this->context)) {
            return null;
        }

        return json_encode($this->context, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
} 