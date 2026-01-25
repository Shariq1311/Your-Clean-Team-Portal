<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Models\User;
use Mojahid\PosSystem\Models\PosOrderItem;

final class PosOrderItemDatatable extends DataTable
{
    public function columns(): array
    {
        return [
            'id' => [
                'label' => "ID",
                'width' => '5%',
            ],
            'product_name' => [
                'label' => trans('Product'),
                'formatter' => function ($value, $row, $index) {
                    return view('cms::backend.items.datatable_item', [
                        'value' => $value,
                        'row' => $row,
                        'actions' => $this->rowAction($row),
                        'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                    ])
                    ->render();
                },
                'width' => '25%',
            ],
            'product_sku' => [
                'label' => trans('SKU'),
                'width' => '10%',
            ],
            'product_price' => [
                'label' => trans('Unit Price'),
                'formatter' => function ($value) {
                    return pos_format_price($value);
                },
                'width' => '10%',
            ],
            'quantity' => [
                'label' => trans('Quantity'),
                'width' => '8%',
            ],
            'total_amount' => [
                'label' => trans('Total'),
                'formatter' => function ($value) {
                    return pos_format_price($value);
                },
                'width' => '10%',
            ],
            'pos_order_id' => [
                'label' => trans('Order'),
                'formatter' => function ($value, $row) {
                    $order = \Mojahid\PosSystem\Models\PosOrder::find($value);
                    return $order ? '#' . $order->order_number : 'N/A';
                },
                'width' => '15%',
            ],
            'created_at' => [
                'label' => trans('cms::app.created_at'),
                'formatter' => function ($value) {
                    return mc_date_format($value);
                },
                'width' => '15%',
            ],
        ];
    }

    public function query(array $data): \Illuminate\Contracts\Database\Query\Builder
    {
        $query = PosOrderItem::select([
            'id',
            'pos_order_id',
            'product_name',
            'product_sku',
            'product_price',
            'quantity',
            'total_amount',
            'created_at',
        ]);

        if ($orderId = Arr::get($data, 'pos_order_id')) {
            $query->where('pos_order_id', $orderId);
        }

        if ($productName = Arr::get($data, 'product_name')) {
            $query->where('product_name', MC_SQL_LIKE, '%' . $productName . '%');
        }

        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(
                function (\Illuminate\Database\Query\Builder $q) use ($keyword) {
                    $q->where('product_name', MC_SQL_LIKE, '%'. $keyword .'%');
                    $q->orWhere('product_sku', MC_SQL_LIKE, '%'. $keyword .'%');
                }
            );
        }

        return $query;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                PosOrderItem::whereIn('id', $ids)->delete();
                break;
        }
    }

    public function rowAction($row): array
    {
        $actions = parent::rowAction($row);

        $actions['view'] = [
            'label' => trans('cms::app.view'),
            'url' => route('admin.pos-system.order-items.show', [$row->id]),
            'class' => 'text-info',
        ];

        if ($row->posOrder && in_array($row->posOrder->status, ['pending', 'hold'])) {
            $actions['edit'] = [
                'label' => trans('cms::app.edit'),
                'url' => route('admin.pos-system.order-items.edit', [$row->id]),
                'class' => 'text-primary',
            ];
        }

        return $actions;
    }
} 