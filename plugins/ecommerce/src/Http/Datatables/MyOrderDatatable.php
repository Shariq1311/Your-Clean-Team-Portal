<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use MojarCMS\CMS\Abstracts\DataTable;
use Mojahid\Ecommerce\Models\Order;

class MyOrderDatatable extends DataTable
{
    /**
     * Columns to display
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'code' => [
                'label' => trans('ecomm::content.order_code'),
                'formatter' => [$this, 'codeFormatter'],
                'width' => '15%',
            ],
            'name' => [
                'label' => trans('ecomm::content.customer'),
                'width' => '20%',
            ],
            'total_price' => [
                'label' => trans('ecomm::content.total'),
                'formatter' => function($value, $row) {
                    return ecom_price_with_unit($row->total_price);
                },
                'width' => '15%',
            ],
            'status' => [
                'label' => trans('ecomm::content.status'),
                'formatter' => function($value, $row) {
                    return $this->getStatusBadge($value);
                },
                'width' => '10%',
            ],
            'payment_status' => [
                'label' => trans('ecomm::content.payment_status'),
                'formatter' => function($value, $row) {
                    return $this->getPaymentStatusBadge($value);
                },
                'width' => '15%',
            ],
            'delivery_status' => [
                'label' => trans('ecomm::content.delivery_status'),
                'formatter' => function($value, $row) {
                    return $this->getDeliveryStatusBadge($value);
                },
                'width' => '15%',
            ],
            'created_at' => [
                'label' => trans('ecomm::content.date'),
                'formatter' => function($value, $row) {
                    return mc_date_format($value);
                },
                'width' => '15%',
            ],
        ];
    }

    /**
     * Format the order code column
     *
     * @param $value
     * @param $row
     * @return string
     */
    public function codeFormatter($value, $row): string
    {
        $route = route('admin.ecommerce.my-orders.show', [$row->id]);
        return '<a href="' . $route . '">' . $value . '</a>';
    }

    /**
     * Query data
     *
     * @param array $data
     * @return Builder
     */
    public function query($data): Builder
    {
        $query = Order::with(['paymentMethod'])
            ->where('user_id', Auth::id());

        // Search functionality
        if ($search = $data['keyword'] ?? null) {
            $query->where(function($q) use ($search) {
                $q->where('code', 'LIKE', "%{$search}%")
                  ->orWhere('title', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Status filter
        if ($status = $data['status'] ?? null) {
            $query->where('status', $status);
        }

        // Date range filter
        if ($dateFrom = $data['date_from'] ?? null) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        if ($dateTo = $data['date_to'] ?? null) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        return $query;
    }

    /**
     * Row action template
     *
     * @param $row
     * @return array
     */
    public function rowAction($row): array
    {
        return [
            'view' => [
                'label' => trans('cms::app.view'),
                'url' => route('admin.ecommerce.my-orders.show', [$row->id]),
                'icon' => 'eye',
            ]
        ];
    }

    /**
     * Search fields
     *
     * @return array
     */
    public function searchFields(): array
    {
        return [
            'keyword' => [
                'type' => 'text',
                'label' => trans('cms::app.search'),
                'placeholder' => trans('cms::app.search_by_name'),
            ],
            'status' => [
                'type' => 'select',
                'label' => trans('cms::app.status'),
                'options' => [
                    'pending' => trans('ecomm::content.pending'),
                    'processing' => trans('ecomm::content.processing'),
                    'completed' => trans('ecomm::content.completed'),
                    'cancelled' => trans('ecomm::content.cancelled'),
                ]
            ]
        ];
    }

    private function getStatusBadge($status): string
    {
        $badges = [
            Order::STATUS_PENDING => '<span class="badge bg-yellow">'.trans('ecomm::content.pending').'</span>',
            Order::STATUS_PROCESSING => '<span class="badge bg-blue">'.trans('ecomm::content.processing').'</span>',
            Order::STATUS_COMPLETED => '<span class="badge bg-green">'.trans('ecomm::content.completed').'</span>',
            Order::STATUS_CANCELLED => '<span class="badge bg-red">'.trans('ecomm::content.cancelled').'</span>',
        ];

        return $badges[$status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    private function getPaymentStatusBadge($status): string
    {
        $badges = [
            Order::PAYMENT_STATUS_PENDING => '<span class="badge bg-yellow">'.trans('ecomm::content.pending').'</span>',
            Order::PAYMENT_STATUS_COMPLETED => '<span class="badge bg-green">'.trans('ecomm::content.completed').'</span>',
            Order::PAYMENT_STATUS_FAILED => '<span class="badge bg-red">'.trans('ecomm::content.failed').'</span>',
        ];

        return $badges[$status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    private function getDeliveryStatusBadge($status): string
    {
        $badges = [
            Order::DELIVERY_STATUS_PENDING => '<span class="badge bg-yellow">'.trans('ecomm::content.pending').'</span>',
            Order::DELIVERY_STATUS_PROCESSING => '<span class="badge bg-blue">'.trans('ecomm::content.processing').'</span>',
            Order::DELIVERY_STATUS_SHIPPED => '<span class="badge bg-blue">'.trans('ecomm::content.shipped').'</span>',
            Order::DELIVERY_STATUS_DELIVERED => '<span class="badge bg-green">'.trans('ecomm::content.delivered').'</span>',
        ];

        return $badges[$status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }
}