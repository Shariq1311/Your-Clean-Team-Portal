<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Repositories\Criterias\FilterCriteria;
use MojarCMS\CMS\Repositories\Criterias\SearchCriteria;
use MojarCMS\CMS\Repositories\Criterias\SortCriteria;
use Mojahid\Ecommerce\Repositories\OrderItemRepository;
use Mojahid\Ecommerce\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class OrderItemDatatable extends DataTable
{
    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'id' => [
                'label' => 'ID',
                'width' => '5%',
                'align' => 'center',
            ],
            'order_id' => [
                'label' => trans('ecomm::content.order_id'),
                'width' => '10%',
                'align' => 'center',
            ],
            'product_title' => [
                'label' => trans('ecomm::content.product'),
                'formatter' => function ($value, $row, $index) {
                    $orderItem = OrderItem::find($row->id);
                    if ($orderItem && $orderItem->post) {
                        return $orderItem->post->title;
                    }
                    return 'N/A';
                }
            ],
            'vendor_name' => [
                'label' => trans('ecomm::content.vendor'),
                'formatter' => function ($value, $row, $index) {
                    $orderItem = OrderItem::find($row->id);
                    if ($orderItem && $orderItem->post && $orderItem->post->createdBy) {
                        return $orderItem->post->createdBy->name;
                    }
                    return 'Admin';
                }
            ],
            'quantity' => [
                'label' => trans('ecomm::content.quantity'),
                'width' => '8%',
                'align' => 'center',
            ],
            'line_price' => [
                'label' => trans('ecomm::content.line_price'),
                'width' => '12%',
                'align' => 'right',
                'formatter' => function ($value, $row, $index) {
                    return '$' . number_format($row->line_price, 2);
                }
            ],
            'price' => [
                'label' => trans('ecomm::content.unit_price'),
                'width' => '12%',
                'align' => 'right',
                'formatter' => function ($value, $row, $index) {
                    return '$' . number_format($row->price, 2);
                }
            ],
            'created_at' => [
                'label' => trans('cms::app.created_at'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return mc_date_format($row->created_at);
                }
            ],
            'operations' => [
                'label' => trans('cms::app.operations'),
                'width' => '10%',
                'align' => 'center',
                'sortable' => false,
                'formatter' => function ($value, $row, $index) {
                    return view(
                        'cms::backend.items.datatable_item',
                        [
                            'value' => $row->title,
                            'row' => $row,
                            'actions' => $this->rowAction($row),
                            'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                            'title_hidden' => true,
                            'actions_hidden' => false,
                        ]
                    )
                    ->render();
                },
            ],
        ];
    }

    /**
     * Query data datatable
     *
     * @param  array  $data
     * @return Builder
     * @throws BindingResolutionException
     */
    public function query(array $data): Builder
    {
        $query = OrderItem::select([
            'id',
            'order_id',
            'post_id',
            'quantity',
            'price',
            'line_price',
            'created_at',
        ]);

        // Filter by vendor if user is vendor
        $user = Auth::user();
        if (Auth::check() && $user) {
            // Check if user has vendor role by checking user metas
            $userType = $user->metas()->where('meta_key', 'user_type')->value('meta_value');
            if ($userType === 'vendor') {
                $vendorId = Auth::id();
                $query->whereHas('post', function ($postQuery) use ($vendorId) {
                    $postQuery->where('created_by', $vendorId);
                });
            }
        }

        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(
                function (Builder $q) use ($keyword) {
                    $q->whereHas('post', function ($postQuery) use ($keyword) {
                        $postQuery->where('title', MC_SQL_LIKE, '%'. $keyword .'%');
                    });
                    $q->orWhere('order_id', MC_SQL_LIKE, '%'. $keyword .'%');
                }
            );
        }

        return $query;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    app(OrderItemRepository::class)->delete($id);
                }
                break;
        }
    }

    public function rowAction($row): array
    {
        $actions = [];

        $actions['view'] = [
            'label' => trans('cms::app.view'),
            'url' => route('admin.order_items.show', [$row->id]),
            'class' => 'text-info',
        ];

        return $actions;
    }
}
