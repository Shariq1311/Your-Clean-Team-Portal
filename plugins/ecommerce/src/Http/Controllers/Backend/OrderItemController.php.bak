<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use MojarCMS\CMS\Traits\ResourceController;
use Illuminate\Support\Facades\Validator;
use MojarCMS\Backend\Http\Controllers\Backend\PageController;
use MojarCMS\CMS\Abstracts\DataTable;
use Mojahid\Ecommerce\Http\Datatables\OrderItemDatatable;
use Mojahid\Ecommerce\Models\OrderItem;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends PageController
{
    use ResourceController;

    protected string $viewPrefix = 'ecomm::backend.order-item';

    protected function getDataTable(...$params): DataTable
    {
        return new OrderItemDatatable();
    }

    protected function validator(array $attributes, ...$params): ValidatorContract
    {
        return Validator::make(
            $attributes,
            [
                // Rules
            ]
        );
    }

    protected function getModel(...$params): string
    {
        return OrderItem::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('ecomm::content.order_item');
    }

    public function show($id)
    {
        $orderItem = OrderItem::with([
            'order.user',
            'order.paymentMethod',
            'post.createdBy'
        ])->findOrFail($id);

        // Check vendor permissions
        $user = Auth::user();
        if ($user) {
            $userType = $user->metas()->where('meta_key', 'user_type')->value('meta_value');
            if ($userType === 'vendor') {
                $vendorId = Auth::id();
                // Check if order item belongs to this vendor
                if (!$orderItem->post || $orderItem->post->created_by !== $vendorId) {
                    abort(403, 'You can only view order items from your products.');
                }
            }
        }

        $data = [
            'orderItem' => $orderItem,
            'title' => trans('ecomm::content.order_item_details') . ' #' . $orderItem->id,
        ];

        return $this->view('ecomm::backend.order-item.show', $data);
    }
}
