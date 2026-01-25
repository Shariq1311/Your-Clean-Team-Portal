<?php

namespace Mojahid\SupportTicket\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Models\User;
use MojarCMS\CMS\Traits\UseChangeBy;

/**
 * Mojahid\SupportTicket\Models\TicketSupportComment
 *
 * @property int $id
 * @property string $content
 * @property array|null $attachments
 * @property string $ticket_support_id
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \MojarCMS\CMS\Models\User|null $createdBy
 * @property-read \MojarCMS\CMS\Models\User|null $updatedBy
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereTicketSupportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketSupportComment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TicketSupportComment extends Model
{
    use UseChangeBy;

    protected $table = 'sticket_ticket_support_comments';

    protected $fillable = [
        'content',
        'ticket_support_id',
        'created_by',
    ];

    public function attachments(): HasMany
    {
        return $this->hasMany(TicketSupportAttachment::class, 'comment_id', 'id');
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(TicketSupport::class, 'ticket_support_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
