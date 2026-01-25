<?php

namespace Mojahid\Ecommerce\Models;

use MojarCMS\CMS\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MojarCMS\CMS\Models\User;

class Wishlist extends Model
{
    protected $table = 'ecomm_wishlists';
    protected $fillable = [
        'code',
        'items',
        'user_id',
        'site_id'
    ];

    protected $casts = [
        'items' => 'array',
        'site_id' => 'integer'
    ];

    protected $attributes = [
        'site_id' => 0
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
} 