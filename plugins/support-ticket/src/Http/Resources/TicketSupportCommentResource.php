<?php
/**
 * Mojar CMS - Laravel CMS for Your Project
 *
 * @package    Mojarcms/Mojarcms
 * @author     Mojar Team
 * @link       https://Mojarcms.com
 * @license    GNU V2
 */

namespace Mojahid\SupportTicket\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketSupportCommentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'content' => htmlentities($this->resource->content),
            'created_at' => mc_date_format($this->resource->created_at),
            'created_by' => [
                'name' => $this->createdBy?->name,
            ],
        ];
    }
}
