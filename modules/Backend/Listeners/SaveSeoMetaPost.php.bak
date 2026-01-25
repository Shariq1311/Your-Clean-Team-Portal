<?php

namespace MojarCMS\Backend\Listeners;

use Illuminate\Support\Arr;
use MojarCMS\Backend\Events\AfterPostSave;
use MojarCMS\Backend\Models\SeoMeta;

class SaveSeoMetaPost
{
    public function handle(AfterPostSave $event): void
    {
        $data = $event->data;
        $title = Arr::get($data, 'meta_title');
        $description = Arr::get($data, 'meta_description');

        if (empty($title) && empty($description)) {
            return;
        }

        SeoMeta::updateOrCreate(
            [
                'object_type' => 'posts',
                'object_id' => $event->post->id,
            ],
            [
                'meta_title' => $title,
                'meta_description' => $description,
            ]
        );
    }
}
