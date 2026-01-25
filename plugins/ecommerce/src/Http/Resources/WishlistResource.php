<?php

namespace Mojahid\Ecommerce\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WishlistResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'code' => $this->resource->getCode(),
            'total_items' => $this->resource->totalItems(),
            'items' => WishlistItemResource::collection($this->resource->getCollectionItems()),
        ];
    }
} 