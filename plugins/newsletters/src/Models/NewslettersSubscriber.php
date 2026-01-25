<?php

namespace Mojahid\Newsletters\Models;

use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Traits\ResourceModel;
use MojarCMS\CMS\Traits\UUIDPrimaryKey;

class NewslettersSubscriber extends Model
{
    use ResourceModel, UUIDPrimaryKey;

    protected $table = 'newsletters_subscribers';

    protected $fillable = [
        'email',
        'metas',
        'site_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'metas' => 'array',
    ];

    public function metas(): array
    {
        return $this->metas ?? [];
    }

    public function setMeta(string $key, string|array $value): void
    {
        $this->metas[$key] = $value;
    }

    public function getMeta(string $key, null|string|array $default = null): string|array
    {
        return $this->metas[$key] ?? $default;
    }
}
