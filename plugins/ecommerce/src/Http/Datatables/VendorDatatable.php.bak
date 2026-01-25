<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Models\User;

class VendorDatatable extends DataTable
{
    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'avatar' => [
                'label' => trans('cms::app.avatar'),
                'width' => '5%',
                'formatter' => function ($value, $row, $index) {
                    return '<img src="' . $row->getAvatar('150x150') . '" class="w-100"/>';
                },
            ],
            'name' => [
                'label' => trans('cms::app.name'),
                'formatter' => function ($value, $row, $index) {
                    return view(
                        'cms::backend.items.datatable_item',
                        [
                            'value' => $row->{$row->getFieldName()},
                            'row' => $row,
                            'actions' => $this->rowAction($row),
                            'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                            'title_hidden' => false,
                            'actions_hidden' => true,
                        ]
                    )
                    ->render();
                },
            ],
            'shop_name' => [
                'label' => trans('ecomm::content.shop_name'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return $row->getMeta('shop_name', '-');
                },
            ],
            'business_phone' => [
                'label' => trans('ecomm::content.business_phone'),
                'width' => '12%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return $row->getMeta('business_phone', '-');
                },
            ],
            'vendor_status' => [
                'label' => trans('ecomm::content.vendor_status'),
                'width' => '10%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    $status = $row->getMeta('user_status', 'approved');
                    $statusLabels = [
                        'under_review' => '<span class="badge bg-warning">' . trans('ecomm::content.under_review') . '</span>',
                        'approved' => '<span class="badge bg-success">' . trans('ecomm::content.approved') . '</span>',
                        'rejected' => '<span class="badge bg-danger">' . trans('ecomm::content.rejected') . '</span>',
                        'suspended' => '<span class="badge bg-secondary">' . trans('ecomm::content.suspended') . '</span>',
                    ];
                    
                    return $statusLabels[$status] ?? '<span class="badge bg-success">' . trans('ecomm::content.approved') . '</span>';
                },
            ],
            'email' => [
                'label' => trans('cms::app.email'),
                'width' => '15%',
                'align' => 'center',
            ],
            'created_at' => [
                'label' => trans('cms::app.created_at'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return mc_date_format($row->created_at);
                },
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

    public function rowAction($row)
    {
        $data = parent::rowAction($row);

        $data['edit'] = [
            'label' => trans('cms::app.edit'),
            'url' => route('admin.vendors.edit', [$row->id]),
        ];

        return $data;
    }

    /**
     * Query data datatable
     *
     * @param array $data
     * @return Builder
     */
    public function query($data)
    {
        $query = User::query();

        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(
                function (Builder $q) use ($keyword) {
                    $q->where('name', MC_SQL_LIKE, '%' . $keyword . '%');
                    $q->orWhere('email', MC_SQL_LIKE, '%' . $keyword . '%');
                }
            );
        }

        // Filter by user_type = 'vendor'
        $query->whereHas('metas', function (Builder $q) {
            $q->where('meta_key', 'user_type')
              ->where('meta_value', 'vendor');
        });

        // Filter by vendor status - show approved vendors
        $query->whereHas('metas', function (Builder $q) {
            $q->where('meta_key', 'user_status')
              ->where('meta_value', 'approved');
        });

        return $query;
    }

    public function bulkActions($action, $ids)
    {
        /* Only update are not master admin  */
        $ids = User::whereIn('id', $ids)
            ->whereIsAdmin(0)
            ->pluck('id')
            ->toArray();

        switch ($action) {
            case 'delete':
                User::destroy($ids);
                break;
        }
    }
} 