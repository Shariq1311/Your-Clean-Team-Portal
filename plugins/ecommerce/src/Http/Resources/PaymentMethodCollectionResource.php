<?php
/**
 * Mojar CMS - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */


 namespace Mojahid\Ecommerce\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentMethodCollectionResource extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(
            function ($item) {
                return array_only(
                    $item->toArray(),
                    [
                        'id',
                        'type',
                        'name',
                        'description',
                    ]
                );
            }
        )->toArray();
    }
}
