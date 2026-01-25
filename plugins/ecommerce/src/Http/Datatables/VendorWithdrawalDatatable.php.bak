<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Repositories\Criterias\FilterCriteria;
use MojarCMS\CMS\Repositories\Criterias\SearchCriteria;
use MojarCMS\CMS\Repositories\Criterias\SortCriteria;
use Mojahid\Ecommerce\Repositories\VendorWithdrawalRepository;
use Mojahid\Ecommerce\Models\VendorWithdrawal;
use Illuminate\Support\Facades\Auth;

class VendorWithdrawalDatatable extends DataTable
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
            'amount' => [
                'label' => trans('ecomm::content.amount'),
                'formatter' => function ($value, $row, $index) {
                    return $row->currency_code . ' ' . number_format($row->amount, 2);
                },
                'width' => '10%',
            ],
            'payment_method' => [
                'label' => trans('ecomm::content.payment_method'),
                'width' => '15%',
            ],
            'status' => [
                'label' => trans('ecomm::content.status'),
                'formatter' => function ($value, $row, $index) {
                    $statusClass = match ($row->status) {
                        'pending' => 'badge bg-warning',
                        'approved' => 'badge bg-info',
                        'rejected' => 'badge bg-danger',
                        'completed' => 'badge bg-success',
                        default => 'badge bg-secondary'
                    };
                    return '<span class="' . $statusClass . '">' . $row->status_text . '</span>';
                },
                'width' => '10%',
            ],
            'notes' => [
                'label' => trans('ecomm::content.notes'),
                'width' => '20%',
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
        $query = VendorWithdrawal::with('vendor');

        // Filter by vendor if user is vendor
        if (Auth::check() && Auth::user()->hasRole('vendor')) {
            $query->where('vendor_id', Auth::id());
        }

        // if (Auth::check()) {
        //     $user = Auth::user();
        //     $userType = $user->metas()->where('meta_key', 'user_type')->value('meta_value');
        //     if ($userType === 'vendor') {
        //         $query->where('vendor_id', Auth::id());
        //     }
        // }
        return $query;
    }

    public function rowAction($row): array
    {
        $actions = [];

        if ($row->isPending()) {
            $actions[] = [
                'label' => trans('ecomm::content.approve_withdrawal'),
                'url' => route('admin.vendor_withdrawals.approve', $row->id),
                'method' => 'GET',
                'class' => 'btn btn-sm btn-success',
                'icon' => 'fa fa-check',
            ];
            $actions[] = [
                'label' => trans('ecomm::content.reject_withdrawal'),
                'url' => route('admin.vendor_withdrawals.reject', $row->id),
                'method' => 'GET',
                'class' => 'btn btn-sm btn-danger',
                'icon' => 'fa fa-times',
            ];
        } elseif ($row->isApproved()) {
            $actions[] = [
                'label' => trans('ecomm::content.complete_withdrawal'),
                'url' => route('admin.vendor_withdrawals.complete', $row->id),
                'method' => 'GET',
                'class' => 'btn btn-sm btn-primary',
                'icon' => 'fa fa-check-double',
            ];
        }

        return $actions;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    app(VendorWithdrawalRepository::class)->delete($id);
                }
                break;
        }
    }
}
