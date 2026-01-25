<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Repositories\Criterias\FilterCriteria;
use MojarCMS\CMS\Repositories\Criterias\SearchCriteria;
use MojarCMS\CMS\Repositories\Criterias\SortCriteria;
use Mojahid\Ecommerce\Repositories\VendorEarningRepository;
use Mojahid\Ecommerce\Models\VendorEarning;
use Illuminate\Support\Facades\Auth;

class VendorEarningDatatable extends DataTable
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
            ],
            'vendor_id' => [
                'label' => trans('ecomm::content.vendor_id'),
                'formatter' => function ($value, $row, $index) {
                    return $row->vendor->name ?? 'N/A';
                },
                'width' => '15%',
            ],
            'order_id' => [
                'label' => trans('ecomm::content.order_id'),
                'width' => '10%',
            ],
            'order_amount' => [
                'label' => trans('ecomm::content.order_amount'),
                'formatter' => function ($value, $row, $index) {
                    return $row->currency_code . ' ' . number_format($row->order_amount, 2);
                },
                'width' => '12%',
            ],
            'commission_rate' => [
                'label' => trans('ecomm::content.commission_rate'),
                'formatter' => function ($value, $row, $index) {
                    return $row->commission_rate . '%';
                },
                'width' => '10%',
            ],
            'commission_amount' => [
                'label' => trans('ecomm::content.commission_amount'),
                'formatter' => function ($value, $row, $index) {
                    return $row->currency_code . ' ' . number_format($row->commission_amount, 2);
                },
                'width' => '12%',
            ],
            'vendor_amount' => [
                'label' => trans('ecomm::content.vendor_amount'),
                'formatter' => function ($value, $row, $index) {
                    return $row->currency_code . ' ' . number_format($row->vendor_amount, 2);
                },
                'width' => '12%',
            ],
            'status' => [
                'label' => trans('ecomm::content.status'),
                'formatter' => function ($value, $row, $index) {
                    $statusClass = match ($row->status) {
                        'pending' => 'badge bg-warning',
                        'completed' => 'badge bg-success',
                        'cancelled' => 'badge bg-danger',
                        default => 'badge bg-secondary'
                    };
                    return '<span class="' . $statusClass . '">' . ucfirst($row->status) . '</span>';
                },
                'width' => '10%',
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
    public function query($data): Builder
    {
        $query = VendorEarning::with(['vendor', 'order']);

        // Filter by vendor if user is vendor
        if (Auth::check() && Auth::user()->hasRole('vendor')) {
            $query->where('vendor_id', Auth::id());
        }

        return $query;
    }

    public function rowAction($row): array
    {
        $actions = [];

        if ($row->isPending() && Auth::check() && Auth::user()->isAdmin()) {
            $actions[] = [
                'label' => trans('ecomm::content.mark_as_completed'),
                'url' => route('admin.vendor_earnings.mark_completed', $row->id),
                'method' => 'GET',
                'class' => 'btn btn-sm btn-success',
                'icon' => 'fa fa-check',
            ];
        }

        return $actions;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    app(VendorEarningRepository::class)->delete($id);
                }
                break;
        }
    }
}
