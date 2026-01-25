<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use MojarCMS\CMS\Abstracts\DataTable;
use Mojahid\Ecommerce\Contracts\WishlistManagerContract;

class MyWishlistDatatable extends DataTable
{
    protected ?Collection $wishlistItems = null;

    /**
     * Columns to display
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'title' => [
                'label' => trans('ecomm::content.product'),
                'formatter' => [$this, 'productFormatter'],
                'width' => '30%',
            ],
            'price' => [
                'label' => trans('ecomm::content.price'),
                'formatter' => function($value, $row) {
                    return ecom_price_with_unit($row->price);
                },
                'width' => '15%',
            ],
            'compare_price' => [
                'label' => trans('ecomm::content.compare_price'),
                'formatter' => function($value, $row) {
                    return !empty($row->compare_price) ? ecom_price_with_unit($row->compare_price) : '-';
                },
                'width' => '15%',
            ],
            'sku_code' => [
                'label' => trans('ecomm::content.sku'),
                'width' => '15%',
            ],
            'added_at' => [
                'label' => trans('ecomm::content.added_date'),
                'formatter' => function($value, $row) {
                    return $value ? mc_date_format($value) : '-';
                },
                'width' => '15%',
            ],
        ];
    }

    /**
     * Format the product title column with thumbnail
     *
     * @param $value
     * @param $row
     * @return string
     */
    public function productFormatter($value, $row): string
    {
        $thumbnail = empty($row->thumbnail) 
            ? '<div class="avatar bg-secondary">-</div>'
            : '<img src="' . upload_url($row->thumbnail) . '" class="avatar" alt="Product" />';

        return '<div class="d-flex align-items-center">
                    ' . $thumbnail . '
                    <div class="ms-2">
                        <div class="font-weight-medium">' . $value . '</div>
                        <div class="text-muted small">' . ($row->type ?? 'products') . '</div>
                    </div>
                </div>';
    }

    /**
     * Query data
     *
     * @param array $data
     * @return Collection
     */
    public function query($data): \Illuminate\Database\Eloquent\Builder
    {
        // Get wishlist items using app() to resolve the WishlistManager
        if ($this->wishlistItems === null) {
            $wishlistManager = app(WishlistManagerContract::class);
            $wishlist = $wishlistManager->find();
            $this->wishlistItems = $wishlist->getCollectionItems();
        }

        // We need to return a builder, so we'll use Post model as a base
        // but we'll override getData() to use our wishlist items
        return \MojarCMS\Backend\Models\Post::whereIn('id', 
            $this->wishlistItems->pluck('post_id')->filter()->toArray()
        );
    }
    
    /**
     * Override the getData method to use our wishlist items directly
     */
    public function getData(\Illuminate\Http\Request $request): array
    {
        // Get wishlist items using app() to resolve the WishlistManager
        if ($this->wishlistItems === null) {
            $wishlistManager = app(WishlistManagerContract::class);
            $wishlist = $wishlistManager->find();
            
            // Force refresh from database to ensure we get latest data
            if ($wishlist) {
                $code = $wishlist->getCode();
                $dbWishlist = \Mojahid\Ecommerce\Models\Wishlist::where('code', $code)->first();
                if ($dbWishlist) {
                    $wishlist = $wishlistManager->find($dbWishlist);
                }
            }
            
            $this->wishlistItems = $wishlist->getCollectionItems();
        }

        // Convert array items to object format for DataTable
        $items = collect();
        foreach ($this->wishlistItems as $item) {
            $itemData = is_array($item) ? $item : $item->toArray();
            $items->push((object) [
                'id' => $itemData['post_id'] ?? null,
                'post_id' => $itemData['post_id'] ?? null,
                'title' => $itemData['title'] ?? 'Unknown Product',
                'thumbnail' => $itemData['thumbnail'] ?? '',
                'price' => $itemData['price'] ?? 0,
                'compare_price' => $itemData['compare_price'] ?? null,
                'sku_code' => $itemData['sku_code'] ?? '-',
                'type' => $itemData['type'] ?? 'products',
                'added_at' => $itemData['added_at'] ?? date('Y-m-d H:i:s'),
            ]);
        }

        return [count($items), $items];
    }

    /**
     * Row action template
     *
     * @param $row
     * @return array
     */
    public function rowAction($row): array
    {
        return [
            'move_to_cart' => [
                'label' => trans('ecomm::content.move_to_cart'),
                'class' => 'btn btn-sm btn-primary move-to-cart',
                'data' => [
                    'post-id' => $row->post_id ?? '',
                    'type' => $row->type ?? 'products'
                ],
                'icon' => 'shopping-cart',
            ],
            'remove' => [
                'label' => trans('ecomm::content.remove'),
                'class' => 'btn btn-sm btn-danger remove-item',
                'data' => [
                    'post-id' => $row->post_id ?? '',
                    'type' => $row->type ?? 'products'
                ],
                'icon' => 'trash',
            ]
        ];
    }
}