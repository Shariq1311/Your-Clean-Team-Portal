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
 * MojarCMS\Backend\Models\TaxonomyMeta
 *
 * @property int $id
 * @property int $taxonomy_id
 * @property string $meta_key
 * @property string|null $meta_value
 * @property-read \MojarCMS\Backend\Models\Taxonomy $taxonomy
 * @method static \Illuminate\Database\Eloquent\Builder|TaxonomyMeta newModelQuery()


 * @method static \Illuminate\Database\Eloquent\Builder|TaxonomyMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxonomyMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxonomyMeta whereId($value)

 * @method static \Illuminate\Database\Eloquent\Builder|TaxonomyMeta whereMetaKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxonomyMeta whereMetaValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxonomyMeta whereTaxonomyId($value)
 * @mixin \Eloquent
 */

class TaxonomyMeta extends Model
{
    public $timestamps = false;

    protected $table = 'taxonomy_metas';
    protected $fillable = [
        'meta_key',
        'meta_value',
        'taxonomy_id',
    ];


    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class, 'taxonomy_id', 'id');
    }

}
