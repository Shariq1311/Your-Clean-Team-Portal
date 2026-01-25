<?php

namespace Mojahid\ContactForm\Models;

use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Traits\ResourceModel;
use MojarCMS\CMS\Traits\UUIDPrimaryKey;

class Contact extends Model
{
    use ResourceModel, UUIDPrimaryKey;

    protected $table = 'contact_form_contacts';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
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
