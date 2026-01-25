<?php

namespace Mojahid\SupportTicket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use MojarCMS\Backend\Models\Post;
use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Models\User;
use MojarCMS\CMS\Traits\ResourceModel;
use MojarCMS\CMS\Traits\UseChangeBy;
use MojarCMS\CMS\Traits\UUIDPrimaryKey;

/**
 * Mojahid\SupportTicket\Models\TicketSupport
 *
 * @property string $id
 * @property int $support_type_id
 * @property string $title
 * @property string|null $content
 * @property array|null $attachments
 * @property int|null $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, TicketSupportComment> $comments
 * @property-read int|null $comments_count
 * @property-read User|null $createdBy
 * @property-read string $status_label
 * @property-read Post|null $product
 * @property-read User|null $updatedBy
 * @method static Builder|TicketSupport newModelQuery()
 * @method static Builder|TicketSupport newQuery()
 * @method static Builder|TicketSupport query()
 * @method static Builder|TicketSupport whereAttachments($value)
 * @method static Builder|TicketSupport whereContent($value)
 * @method static Builder|TicketSupport whereCreatedAt($value)
 * @method static Builder|TicketSupport whereCreatedBy($value)
 * @method static Builder|TicketSupport whereFilter($params = [])
 * @method static Builder|TicketSupport whereId($value)
 * @method static Builder|TicketSupport whereSupportTypeId($value)
 * @method static Builder|TicketSupport whereTitle($value)
 * @method static Builder|TicketSupport whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TicketSupport extends Model
{
    use UUIDPrimaryKey, UseChangeBy, ResourceModel;

    protected $keyType = 'string';

    protected $table = 'sticket_ticket_supports';

    protected $fillable = [
        'support_type_id',
        'title',
        'content',
        'created_by',
        'product_id',
        'status',
        'priority',
        'rating',
        'rating_feedback',
        'rated_at',
        'auto_close_at',
        'last_activity_at',
        'escalated_at',
        'escalated_to',
        'assigned_to',
        'assigned_at',
        'first_response_at',
        'response_time_minutes',
        'customer_satisfaction_score',
        'tags',
        'category',
        'external_id',
        'source',
        'sla_deadline',
        'sla_breached',
    ];

    protected $appends = ['status_label'];

    protected $casts = [
        'tags' => 'array',
        'rated_at' => 'datetime',
        'auto_close_at' => 'datetime',
        'last_activity_at' => 'datetime',
        'escalated_at' => 'datetime',
        'assigned_at' => 'datetime',
        'first_response_at' => 'datetime',
        'sla_deadline' => 'datetime',
        'sla_breached' => 'boolean',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_REPLIED = 'replied';
    public const STATUS_CLOSE = 'close';

    public static function getStatuses(): array
    {
        return [
            static::STATUS_PENDING => __('Pending'),
            static::STATUS_REPLIED => __('Replied'),
            static::STATUS_CLOSE => __('Close'),
        ];
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TicketSupportComment::class, 'ticket_support_id', 'id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TicketSupportAttachment::class, 'ticket_support_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TicketSupportType::class, 'support_type_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            static::STATUS_REPLIED => __('Replied'),
            self::STATUS_CLOSE => __('Close'),
            default => __('Pending'),
        };
    }

    public function getPriorityLabelAttribute(): string
    {
        return match ($this->priority) {
            'urgent' => __('Urgent'),
            'high' => __('High'),
            'medium' => __('Medium'),
            'low' => __('Low'),
            default => __('Medium'),
        };
    }

    public function scopeOpen($query)
    {
        return $query->where('status', '!=', self::STATUS_CLOSE);
    }

    public function scopeClosed($query)
    {
        return $query->where('status', self::STATUS_CLOSE);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    public function scopeUnassigned($query)
    {
        return $query->whereNull('assigned_to');
    }

    public function scopeOverdue($query)
    {
        return $query->where('sla_deadline', '<', now())
                    ->where('status', '!=', self::STATUS_CLOSE);
    }

    public function scopeNeedsResponse($query)
    {
        return $query->where('status', self::STATUS_PENDING)
                    ->where('created_at', '<', now()->subHours(24));
    }

    public function updateLastActivity()
    {
        $this->update(['last_activity_at' => now()]);
    }

    public function markAsRated($rating, $feedback = null)
    {
        $this->update([
            'rating' => $rating,
            'rating_feedback' => $feedback,
            'rated_at' => now(),
        ]);
    }

    public function assignTo($userId)
    {
        $this->update([
            'assigned_to' => $userId,
            'assigned_at' => now(),
        ]);
    }

    public function escalateTo($level)
    {
        $this->update([
            'escalated_at' => now(),
            'escalated_to' => $level,
        ]);
    }

    public function setSlaDeadline($hours = 24)
    {
        $this->update([
            'sla_deadline' => now()->addHours($hours),
        ]);
    }
}
