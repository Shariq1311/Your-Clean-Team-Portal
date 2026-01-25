<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Repositories\Criterias\FilterCriteria;
use MojarCMS\CMS\Repositories\Criterias\SearchCriteria;
use MojarCMS\CMS\Repositories\Criterias\SortCriteria;
use Mojahid\Ecommerce\Repositories\VendorBalanceRepository;
use Mojahid\Ecommerce\Models\VendorBalance;
use Illuminate\Support\Facades\Auth;

class VendorBalanceDatatable extends DataTable
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
                'width' => '20%',
            ],
            'balance' => [
                'label' => trans('ecomm::content.available_balance'),
                'formatter' => function ($value, $row, $index) {
                    return $row->currency_code . ' ' . number_format($row->balance, 2);
                },
                'width' => '15%',
            ],
            'pending_balance' => [
                'label' => trans('ecomm::content.pending_earnings'),
                'formatter' => function ($value, $row, $index) {
                    return $row->currency_code . ' ' . number_format($row->pending_balance, 2);
                },
                'width' => '15%',
            ],
            'total_earnings' => [
                'label' => trans('ecomm::content.total_earnings'),
                'formatter' => function ($value, $row, $index) {
                    return $row->currency_code . ' ' . number_format($row->total_earnings, 2);
                },
                'width' => '15%',
            ],
            'total_withdrawals' => [
                'label' => trans('ecomm::content.total_withdrawals'),
                'formatter' => function ($value, $row, $index) {
                    return $row->currency_code . ' ' . number_format($row->total_withdrawals, 2);
                },
                'width' => '15%',
            ],
            'currency_code' => [
                'label' => trans('ecomm::content.currency_code'),
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
    public function query(array $data): Builder
    {
        $query = VendorBalance::with('vendor');

        // Filter by vendor if user is vendor
        if (Auth::check() && Auth::user()->hasRole('vendor')) {
            $query->where('vendor_id', Auth::id());
        }

        return $query;
    }

    public function rowAction($row): array
    {
        $actions = [];

        // Add withdrawal request action for vendors
        if (Auth::check() && Auth::user()->hasRole('vendor') && $row->vendor_id === Auth::id()) {
            if ($row->balance > 0) {
                $actions[] = [
                    'label' => trans('ecomm::content.request_withdrawal'),
                    'url' => route('admin.vendor_withdrawals.create'),
                    'method' => 'GET',
                    'class' => 'btn btn-sm btn-primary',
                    'icon' => 'fa fa-money-bill',
                ];
            }
        }

        return $actions;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    app(VendorBalanceRepository::class)->delete($id);
                }
                break;
        }
    }
}
