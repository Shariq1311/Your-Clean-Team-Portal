<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Models\User;
use Mojahid\PosSystem\Models\PosOrder;

final class PosOrderDatatable extends DataTable
{
    protected string $sortName = 'created_at';
    protected string $sortOder = 'desc';

    public function columns(): array
    {
        return [
            'order_number' => [
                'label' => trans('Order Number'),
                'formatter' => function ($value, $row, $index) {
                    return view('cms::backend.items.datatable_item', [
                        'value' => $row->customer_name,
                        'row' => $row,
                        'actions' => $this->rowAction($row),
                        'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                        'title_hidden' => false,
                        'actions_hidden' => true,
                    ])
                    ->render();
                },
                'width' => '20%',
            ],
            'customer_name' => [
                'label' => trans('Customer'),
                'width' => '15%',
            ],
            'total_amount' => [
                'label' => trans('Total'),
                'formatter' => function ($value) {
                    return pos_format_price($value);
                },
                'width' => '10%',
            ],
            'payment_method' => [
                'label' => trans('Payment Method'),
                'formatter' => [$this, 'paymentMethodFormatter'],
                'width' => '10%',
            ],
            'status' => [
                'label' => trans('Status'),
                'formatter' => [$this, 'statusFormatter'],
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
                            'value' => $row->id,
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

    public function statusFormatter($value, $row): string
    {
        return match ($value) {
            'pending' => '<span class="badge badge-warning">Pending</span>',
            'completed' => '<span class="badge badge-success">Completed</span>',
            'hold' => '<span class="badge badge-info">Hold</span>',
            'cancelled' => '<span class="badge badge-danger">Cancelled</span>',
            'refunded' => '<span class="badge badge-secondary">Refunded</span>',
            default => '<span class="badge badge-light">' . ucfirst($value) . '</span>',
        };
    }

    public function paymentMethodFormatter($value, $row): string
    {
        return match ($value) {
            'cash' => '<span class="badge badge-success">Cash</span>',
            'card' => '<span class="badge badge-primary">Card</span>',
            'digital' => '<span class="badge badge-info">Digital</span>',
            default => '<span class="badge badge-light">' . ucfirst($value) . '</span>',
        };
    }

    public function query(array $data): \Illuminate\Contracts\Database\Query\Builder
    {
        $query = PosOrder::select([
            'id',
            'order_number',
            'customer_name',
            'customer_phone',
            'customer_email',
            'total_amount',
            'payment_method',
            'status',
            'created_at',
        ]);

        if ($status = Arr::get($data, 'status')) {
            $query->where('status', $status);
        }

        if ($paymentMethod = Arr::get($data, 'payment_method')) {
            $query->where('payment_method', $paymentMethod);
        }

        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(
                function (\Illuminate\Database\Query\Builder $q) use ($keyword) {
                    $q->where('order_number', MC_SQL_LIKE, '%'. $keyword .'%');
                    $q->orWhere('customer_name', MC_SQL_LIKE, '%'. $keyword .'%');
                    $q->orWhere('customer_phone', MC_SQL_LIKE, '%'. $keyword .'%');
                }
            );
        }

        return $query;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                PosOrder::whereIn('id', $ids)->delete();
                break;
            case 'change_status_completed':
                PosOrder::whereIn('id', $ids)->update(['status' => 'completed']);
                break;
            case 'change_status_cancelled':
                PosOrder::whereIn('id', $ids)->update(['status' => 'cancelled']);
                break;
        }
    }

    public function rowAction($row): array
    {
        $actions = parent::rowAction($row);

        // $actions['view'] = [
        //     'label' => trans('cms::app.view'),
        //     'url' => route('admin.orders.show', [$row->id]),
        //     'class' => 'text-info',
        // ];

        $actions['show'] = [
            'label' => trans('cms::app.view'),
            'url' => route('admin.pos-system.orders.show', [$row->id]),
            'class' => 'text-info',
        ];

        return $actions;
    }
} 