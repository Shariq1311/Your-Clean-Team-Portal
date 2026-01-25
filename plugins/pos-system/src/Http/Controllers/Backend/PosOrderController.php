<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use MojarCMS\CMS\Http\Controllers\BackendController;
use MojarCMS\CMS\Traits\ResourceController;
use Mojahid\PosSystem\Http\Datatables\PosOrderDatatable;
use Mojahid\PosSystem\Models\PosOrder;

final class PosOrderController extends BackendController
{
    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected string $viewPrefix = 'pos::backend.order';

    protected function getDataTable(...$params)
    {
        return new PosOrderDatatable();
    }

    protected function validator(array $attributes, ...$params): \Illuminate\Validation\Validator
    {
        return Validator::make(
            $attributes,
            [
                'order_number' => 'required|string|unique:pos_orders,order_number,' . ($params[0]->id ?? 'NULL'),
                'customer_name' => 'required|string|max:255',
                'customer_phone' => 'nullable|string|max:20',
                'customer_email' => 'nullable|email|max:255',
                'payment_method' => 'required|string|in:cash,card,digital',
                'status' => 'required|string|in:pending,completed,hold,cancelled,refunded',
                'subtotal' => 'required|numeric|min:0',
                'tax_amount' => 'required|numeric|min:0',
                'discount_amount' => 'required|numeric|min:0',
                'total_amount' => 'required|numeric|min:0',
                'paid_amount' => 'required|numeric|min:0',
                'change_amount' => 'required|numeric|min:0',
                'notes' => 'nullable|string',
            ]
        );
    }

    protected function getModel(...$params): string
    {
        return PosOrder::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('POS Orders');
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model, ...$params);
        
        $data['payment_methods'] = pos_get_payment_method_options();
        $data['statuses'] = pos_get_order_status_options();
        
        return $data;
    }

    protected function parseDataForSave(array $attributes, ...$params): array
    {
        // Remove any content field that might be sent by the framework
        unset($attributes['content']);
        
        // Calculate change amount
        if (isset($attributes['paid_amount']) && isset($attributes['total_amount'])) {
            $attributes['change_amount'] = max(0, $attributes['paid_amount'] - $attributes['total_amount']);
        }

        // Set completed_at timestamp if status is completed
        if (isset($attributes['status']) && $attributes['status'] === PosOrder::STATUS_COMPLETED) {
            $attributes['completed_at'] = now();
        }

        return $attributes;
    }

    protected function beforeSave(&$data, &$model, ...$params): void
    {
        $data['user_id'] = auth()->id();
    }

    protected function afterSave($data, $model, ...$params): void
    {
        // Update session totals if order is completed
        if ($model->status === PosOrder::STATUS_COMPLETED) {
            $this->updateSessionTotals($model);
        }
    }

    public function show($id): View
    {
        $order = PosOrder::with(['orderItems.post', 'user', 'posSession'])->findOrFail($id);

        $this->addBreadcrumb([
            'title' => trans('POS Orders'),
            'url' => route('admin.orders.index'),
        ]);

        $this->addBreadcrumb([
            'title' => 'Order #' . $order->order_number,
            'url' => route('admin.orders.show', $id),
        ]);

        $data = [
            'order' => $order,
            'title' => 'Order #' . $order->order_number,
        ];

        return $this->view('pos::backend.order.show', $data);
    }

    public function printReceipt($id): View|JsonResponse
    {
        $order = PosOrder::with(['orderItems', 'user'])->findOrFail($id);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'receipt_html' => view('pos::backend.order.receipt', compact('order'))->render(),
            ]);
        }

        return $this->view('pos::backend.order.receipt', compact('order'));
    }

    public function refund(Request $request, $id): JsonResponse|RedirectResponse
    {
        $order = PosOrder::findOrFail($id);

        if (!in_array($order->status, [PosOrder::STATUS_COMPLETED])) {
            $message = 'Only completed orders can be refunded';
            
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $message], 400);
            }
            
            return redirect()->back()->with('error', $message);
        }

        $request->validate([
            'refund_amount' => 'required|numeric|min:0.01|max:' . $order->total_amount,
            'refund_reason' => 'nullable|string|max:500',
        ]);

        // Create refund logic here
        $order->update([
            'status' => PosOrder::STATUS_REFUNDED,
            'order_data' => array_merge($order->order_data ?? [], [
                'refund' => [
                    'amount' => $request->refund_amount,
                    'reason' => $request->refund_reason,
                    'refunded_at' => now(),
                    'refunded_by' => auth()->id(),
                ],
            ]),
        ]);

        $message = 'Order refunded successfully';

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function bulkActions(Request $request, ...$params): JsonResponse|RedirectResponse
    {
        $request->validate([
            'action' => 'required|string|in:delete,change_status,export',
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:pos_orders,id',
            'status' => 'required_if:action,change_status|string|in:pending,completed,hold,cancelled,refunded',
        ]);

        $orders = PosOrder::whereIn('id', $request->ids);
        $message = '';

        switch ($request->action) {
            case 'delete':
                $count = $orders->delete();
                $message = "Deleted {$count} orders successfully";
                break;

            case 'change_status':
                $count = $orders->update(['status' => $request->status]);
                $message = "Updated status for {$count} orders successfully";
                break;

            case 'export':
                // Implement export functionality
                $message = "Export functionality to be implemented";
                break;
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return redirect()->back()->with('success', $message);
    }

    protected function updateSessionTotals(PosOrder $order): void
    {
        if (!$order->posSession) {
            return;
        }

        $session = $order->posSession;
        $amount = $order->total_amount;

        switch ($order->payment_method) {
            case PosOrder::PAYMENT_CASH:
                $session->increment('total_cash_sales', $amount);
                break;
            case PosOrder::PAYMENT_CARD:
                $session->increment('total_card_sales', $amount);
                break;
            case PosOrder::PAYMENT_DIGITAL:
                $session->increment('total_digital_sales', $amount);
                break;
        }

        $session->increment('total_transactions');
        $session->save();
    }
} 