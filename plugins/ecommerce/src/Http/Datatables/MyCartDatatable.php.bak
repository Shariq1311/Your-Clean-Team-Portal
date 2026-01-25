<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use MojarCMS\CMS\Abstracts\DataTable;
use Mojahid\Ecommerce\Contracts\CartManagerContract;

class MyCartDatatable extends DataTable
{
    protected ?Collection $cartItems = null;

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
            'quantity' => [
                'label' => trans('ecomm::content.quantity'),
                'formatter' => function($value, $row) {
                    return $this->quantityFormatter($value, $row);
                },
                'width' => '20%',
            ],
            'line_price' => [
                'label' => trans('ecomm::content.total'),
                'formatter' => function($value, $row) {
                    return ecom_price_with_unit($row->line_price);
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
        // dd($row);
        $thumbnail = empty($row->thumbnail) 
            ? '<div class="avatar bg-secondary">-</div>'
            : '<img src="' . upload_url($row->thumbnail) . '" class="avatar" alt="Product" />';

        return '<div class="d-flex align-items-center">
                    ' . $thumbnail . '
                    <div class="ms-2">
                        <div class="font-weight-medium">' . $value . '</div>
                        <div class="text-muted small">' . ($row->sku_code ?? '-') . '</div>
                    </div>
                </div>';
    }

    /**
     * Format the quantity column with input
     *
     * @param $value
     * @param $row
     * @return string
     */
    public function quantityFormatter($value, $row): string
    {
        return '<div class="input-group" style="width: 120px;">
                    <span class="input-group-text btn btn-sm btn-secondary decrease-quantity" data-post-id="' . ($row->post_id ?? '') . '" data-type="' . ($row->type ?? 'products') . '">-</span>
                    <input type="number" class="form-control quantity-input" value="' . ($value ?? 1) . '" min="1" data-post-id="' . ($row->post_id ?? '') . '" data-type="' . ($row->type ?? 'products') . '">
                    <span class="input-group-text btn btn-sm btn-secondary increase-quantity" data-post-id="' . ($row->post_id ?? '') . '" data-type="' . ($row->type ?? 'products') . '">+</span>
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
        // Get cart items using app() to resolve the CartManager
        if ($this->cartItems === null) {
            $cartManager = app(CartManagerContract::class);
            $cart = $cartManager->find();
            $this->cartItems = $cart->getCollectionItems();
        }

        // We need to return a builder, so we'll use Post model as a base
        // but we'll override getData() to use our cart items
        return \MojarCMS\Backend\Models\Post::whereIn('id', 
            $this->cartItems->pluck('post_id')->filter()->toArray()
        );
    }
    
    /**
     * Override the getData method to use our cart items directly
     */
    public function getData(\Illuminate\Http\Request $request): array
    {
        // Get cart items using app() to resolve the CartManager
        if ($this->cartItems === null) {
            $cartManager = app(CartManagerContract::class);
            $cart = $cartManager->find();
            $this->cartItems = $cart->getCollectionItems();
        }

        // Convert array items to object format for DataTable
        $items = collect();
        foreach ($this->cartItems as $item) {
            $itemData = is_array($item) ? $item : $item->toArray();
            $items->push((object) [
                'id' => $itemData['post_id'] ?? null,
                'post_id' => $itemData['post_id'] ?? null,
                'title' => $itemData['title'] ?? 'Unknown Product',
                'thumbnail' => $itemData['thumbnail'] ?? '',
                'price' => $itemData['price'] ?? 0,
                'quantity' => $itemData['quantity'] ?? 1,
                'line_price' => ($itemData['price'] ?? 0) * ($itemData['quantity'] ?? 1),
                'sku_code' => $itemData['sku_code'] ?? '-',
                'type' => $itemData['type'] ?? 'products',
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
            'remove' => [
                'label' => trans('cms::app.remove'),
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