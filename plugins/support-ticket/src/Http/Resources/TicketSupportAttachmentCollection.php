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

use Illuminate\Http\Resources\Json\ResourceCollection;

class TicketSupportAttachmentCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return $this->collection->map(
            fn($item) => [
                'id' => $item->id,
                'path' => $item->path,
                'name' => $item->name,
                'extension' => $item->extension,
                'minetype' => $item->minetype,
            ]
        )->toArray();
    }
}
