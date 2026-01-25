<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com/cms
 * @license    MIT
 */

namespace MojarCMS\Backend\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MediaFolderCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return $this->collection->map(
            function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'url' => '',
                    'size' => '',
                    'updated' => strtotime($item->updated_at),
                    'path' => $item->id,
                    'time' => (string) $item->created_at,
                    'type' => $item->type,
                    'icon' => 'fa-folder-o',
                    'thumb' => asset('mc-styles/Mojar/images/folder.png'),
                    'is_file' => false,
                ];
            }
        )->toArray();
    }
}
