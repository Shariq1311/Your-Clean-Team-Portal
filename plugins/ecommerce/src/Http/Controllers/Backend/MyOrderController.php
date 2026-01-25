<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use MojarCMS\CMS\Http\Controllers\BackendController;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Auth;
use Mojahid\Ecommerce\Http\Datatables\MyOrderDatatable;

class MyOrderController extends BackendController
{
    public function index(): View
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $dataTable = new MyOrderDatatable();
        
        return view('ecomm::backend.my-order.index', [
            'dataTable' => $dataTable,
            'title' => trans('ecomm::content.my_orders'),
        ]);
    }

    public function show($id): View
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $order = Order::with(['paymentMethod', 'orderItems.post'])
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$order) {
            abort(404, 'Order not found');
        }

        // Get the order data and add badges
        $orderData = OrderResource::make($order)->toArray(request());
        $orderData['status_badge'] = $this->getStatusBadge($order->status ?? 'pending');
        $orderData['payment_status_badge'] = $this->getPaymentStatusBadge($order->payment_status ?? 'pending');
        $orderData['delivery_status_badge'] = $this->getDeliveryStatusBadge($order->delivery_status ?? 'pending');

        // Format order items for proper display
    if (isset($orderData['items']) && is_array($orderData['items'])) {
        foreach ($orderData['items'] as &$item) {
            $item['line_price'] = ecom_price_with_unit((float)(intval($item['price']) * intval($item['quantity'])));
        }
    }

        return view('ecomm::backend.my-order.show', [
            'order' => $orderData,
            'title' => trans('ecomm::content.order_details'),
        ]);
    }

    public function datatable(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $dataTable = new MyOrderDatatable();
        return $dataTable->ajax($request);
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

    private function getActions($order): string
    {
        $actions = '<div class="btn-list">';
        $actions .= '<a href="' . route('admin.ecommerce.my-orders.show', $order->id) . '" class="btn btn-sm btn-primary">';
        $actions .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>';
        $actions .= ' View</a>';
        $actions .= '</div>';

        return $actions;
    }
} 