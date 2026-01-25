<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    GNU General Public License v2.0
 */

namespace MojarCMS\API\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use MojarCMS\Backend\Models\Menu;

/**
 * @property Menu $resource
 */
class MenuResource extends JsonResource
{
    public function toArray($request): array
    {
        $this->resource->load(
            [
                'items.recursiveChildren' => fn($q) => $q->cacheFor(
                    config('Mojar.performance.query_cache.lifetime')
                )
            ]
        );

        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'location' => $this->resource->getLocation(),
            'items' => MenuItemCollection::make($this->resource->items),
        ];
    }
}
