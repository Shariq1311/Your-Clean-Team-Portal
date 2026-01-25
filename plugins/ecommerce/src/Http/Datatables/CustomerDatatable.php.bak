<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Models\User;

class CustomerDatatable extends DataTable
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
            'user_type' => [
                'label' => trans('cms::app.user_type'),
                'width' => '10%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return $row->getMeta('user_type', 'customer');
                },
            ],
            'status' => [
                'label' => trans('cms::app.status'),
                'width' => '10%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return $row->status;
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
            'url' => route('admin.users.edit', [$row->id]),
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

        if ($status = Arr::get($data, 'status')) {
            $query->where('status', '=', $status);
        } else {
            $query->where('status', '=', 'active');
        }

        // Filter by user_type = 'customer'
        $query->whereHas('metas', function (Builder $q) {
            $q->where('meta_key', 'user_type')
              ->where('meta_value', 'customer');
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
