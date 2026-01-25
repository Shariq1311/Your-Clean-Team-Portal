<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use MojarCMS\CMS\Abstracts\DataTable;
use Mojahid\Ecommerce\Models\Discount;

class DiscountDatatable extends DataTable
{
    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'title' => [
                'label' => trans('ecomm::content.title'),
                'formatter' => function ($value, $row, $index) {
                    return view(
                        'cms::backend.items.datatable_item',
                        [
                            'value' => $row->title,
                            'row' => $row,
                            'actions' => $this->rowAction($row),
                            'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                            'title_hidden' => false,
                            'actions_hidden' => true,
                        ]
                    )->render();
                },
                'width' => '25%',
            ],
            'code' => [
                'label' => trans('ecomm::content.code'),
                'width' => '15%',
                'formatter' => function ($value, $row, $index) {
                    return '<span class="badge badge-light font-monospace">' . $value . '</span>';
                },
            ],
            'type' => [
                'label' => trans('ecomm::content.type'),
                'width' => '10%',
                'formatter' => function ($value, $row, $index) {
                    $types = Discount::getTypes();
                    return $types[$value] ?? $value;
                },
            ],
            'value' => [
                'label' => trans('ecomm::content.value'),
                'width' => '10%',
                'formatter' => function ($value, $row, $index) {
                    return $row->getFormattedValue();
                },
            ],
            'usage' => [
                'label' => trans('ecomm::content.usage'),
                'width' => '10%',
                'sortable' => false,
                'formatter' => function ($value, $row, $index) {
                    $limit = $row->usage_limit ? $row->usage_limit : '∞';
                    return "{$row->used_count} / {$limit}";
                },
            ],
            'dates' => [
                'label' => trans('ecomm::content.validity'),
                'width' => '15%',
                'sortable' => false,
                'formatter' => function ($value, $row, $index) {
                    $start = $row->start_date ? $row->start_date->format('M d, Y') : 'No start';
                    $end = $row->end_date ? $row->end_date->format('M d, Y') : 'No end';
                    return "<small>{$start}<br>to {$end}</small>";
                },
            ],
            'status' => [
                'label' => trans('cms::app.status'),
                'width' => '10%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return $row->getStatusBadge();
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
                            'value' => $row->title,
                            'row' => $row,
                            'actions' => $this->rowAction($row),
                            'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                            'title_hidden' => true,
                            'actions_hidden' => false,
                        ]
                    )->render();
                },
            ],
        ];
    }

    public function rowAction($row): array
    {
        $actions = parent::rowAction($row);

        $actions['edit'] = [
            'label' => trans('cms::app.edit'),
            'url' => route('admin.discounts.edit', [$row->id]),
        ];

        return $actions;
    }

    /**
     * Query data datatable
     *
     * @param array $data
     * @return Builder
     */
    public function query($data): Builder
    {
        $query = Discount::query();

        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('code', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('description', 'LIKE', '%' . $keyword . '%');
            });
        }

        if ($status = Arr::get($data, 'status')) {
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        if ($type = Arr::get($data, 'type')) {
            $query->where('type', $type);
        }

        return $query;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                Discount::destroy($ids);
                break;
            case 'activate':
                Discount::whereIn('id', $ids)->update(['is_active' => true]);
                break;
            case 'deactivate':
                Discount::whereIn('id', $ids)->update(['is_active' => false]);
                break;
        }
    }

    public function searchFields(): array
    {
        return [
            'status' => [
                'type' => 'select',
                'label' => trans('cms::app.status'),
                'options' => [
                    '' => trans('cms::app.all'),
                    'active' => trans('cms::app.active'),
                    'inactive' => trans('cms::app.inactive'),
                ]
            ],
            'type' => [
                'type' => 'select',
                'label' => trans('ecomm::content.type'),
                'options' => [
                    '' => trans('cms::app.all'),
                    'percentage' => 'Percentage',
                    'fixed' => 'Fixed Amount',
                ]
            ]
        ];
    }
} 