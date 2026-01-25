<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Backend\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MojarCMS\CMS\Models\Model;

/**
 * MojarCMS\Backend\Models\PostMeta
 *
 * @property int $id
 * @property int $post_id
 * @property string $meta_key
 * @property string|null $meta_value
 * @property-read \MojarCMS\Backend\Models\Post $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta whereMetaKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta whereMetaValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta wherePostId($value)
 * @mixin \Eloquent
 */
class PostMeta extends Model
{
    public $timestamps = false;

    protected $table = 'post_metas';
    protected $fillable = [
        'meta_key',
        'meta_value',
        'post_id',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
