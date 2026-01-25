<?php

namespace Mojahid\Ecommerce\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WishlistItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'key' => $this['type'] . '_' . $this['post_id'],
            'post_id' => $this['post_id'],
            'type' => $this['type'],
            'title' => (string) $this['title'],
            'url' => $this['url'] ?? null,
            'thumbnail' => upload_url($this['thumbnail']),
            'compare_price' => (float) ($this['compare_price'] ?? 0),
            'compare_price_formatted' => ecom_price_with_unit($this['compare_price'] ?? 0),
            'price' => (float) $this['price'],
            'price_formatted' => ecom_price_with_unit($this['price']),
            'added_at' => $this['added_at'] ?? null,
            'metadata' => $this['metadata'],
        ];
    }
} 