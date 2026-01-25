<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use MojarCMS\CMS\Abstracts\DataTable;
use Mojahid\Ecommerce\Models\Order;
use Illuminate\Support\Facades\Auth;
use MojarCMS\CMS\Models\User;
use Mojahid\Ecommerce\Models\OrderItem;

class OrderDatatable extends DataTable
{
    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'code' => [
                'label' => trans('ecomm::content.code'),
                'formatter' => function ($value, $row, $index) {
                    return view('cms::backend.items.datatable_item', [
                        'value' => $row->name,
                        'row' => $row,
                        'actions' => $this->rowAction($row),
                        'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                        'title_hidden' => false,
                        'actions_hidden' => true,
                    ])
                    ->render();
                },
                'width' => '15%',
            ],
            'name' => [
                'label' => trans('ecomm::content.name'),
                'width' => '20%',
            ],
            'phone' => [
                'label' => trans('ecomm::content.phone'),
            ],
            'email' => [
                'label' => trans('ecomm::content.email'),
            ],
            'total' => [
                'label' => trans('ecomm::content.total'),
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
                            'value' => $row->{$row->getFieldName()},
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
     */
    public function query(array $data): \Illuminate\Contracts\Database\Query\Builder
    {
        $query = Order::select(
            [
                'id',
                'code',
                'name',
                'email',
                'phone',
                'total',
                'created_at',
            ]
        );

        // Filter by vendor if user is vendor
        $user = Auth::user();
        if (Auth::check() && $user) {
            // Check if user has vendor role by checking user metas
            $userType = $user->metas()->where('meta_key', 'user_type')->value('meta_value');
            if ($userType === 'vendor') {
                $vendorId = Auth::id();
                $query->whereHas('orderItems', function ($q) use ($vendorId) {
                    $q->whereHas('post', function ($postQuery) use ($vendorId) {
                        $postQuery->whereHas('metas', function ($metaQuery) use ($vendorId) {
                            $metaQuery->where('meta_key', 'vendor_id')
                                ->where('meta_value', $vendorId);
                        });
                    });
                });
            }
        }

        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(
                function (Builder $q) use ($keyword) {
                    $q->where('name', MC_SQL_LIKE, '%'. $keyword .'%');
                    $q->orWhere('email', MC_SQL_LIKE, '%'. $keyword .'%');
                    $q->orWhere('phone', MC_SQL_LIKE, '%'. $keyword .'%');
                }
            );
        }

        return $query;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                Order::destroy($ids);
                break;
        }
    }

    public function rowAction($row): array
    {
        $actions = parent::rowAction($row);

        $actions['view'] = [
            'label' => trans('cms::app.view'),
            'url' => route('admin.orders.show', [$row->id]),
            'class' => 'text-info',
        ];

        $actions['edit'] = [
            'label' => trans('cms::app.edit'),
            'url' => route('admin.orders.edit', [$row->id]),
            'class' => 'text-primary',
        ];

        return $actions;
    }
}
