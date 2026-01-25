<?php
/**
 * Mojahid CMS - The Best CMS for Laravel Project
 *
 * @package    Mojarcms/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojarcms.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MojarCMS\CMS\Models\Model;

/**
 * MojarCMS\Ecommerce\Models\VariantName
 *
 * @property-read Collection|VariantNameItem[] $items
 * @property-read int|null $items_count
 * @method static Builder|VariantName newModelQuery()
 * @method static Builder|VariantName newQuery()
 * @method static Builder|VariantName query()
 * @mixin Eloquent
 */
class VariantName extends Model
{
    protected $table = 'variant_names';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function items(): HasMany
    {
        return $this->hasMany(VariantNameItem::class, 'variant_name_id', 'id');
    }
}
