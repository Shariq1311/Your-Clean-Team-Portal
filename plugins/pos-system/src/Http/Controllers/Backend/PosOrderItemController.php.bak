<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use MojarCMS\Backend\Http\Controllers\Backend\PageController;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Traits\ResourceController;
use Mojahid\PosSystem\Http\Datatables\PosOrderItemDatatable;
use Mojahid\PosSystem\Models\PosOrderItem;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;

final class PosOrderItemController extends PageController
{
    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected string $viewPrefix = 'pos::backend.order-item';

    protected function getDataTable(...$params): DataTable
    {
        return new PosOrderItemDatatable();
    }

    protected function validator(array $attributes, ...$params): ValidatorContract
    {
        return Validator::make(
            $attributes,
            [
                // Validation rules for order items
            ]
        );
    }

    protected function getModel(...$params): string
    {
        return PosOrderItem::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('POS Order Items');
    }

    public function show($id)
    {
        $orderItem = PosOrderItem::with(['posOrder', 'post'])->findOrFail($id);

        $this->addBreadcrumb([
            'title' => trans('POS Order Items'),
            'url' => route('admin.pos-system.order-items.index'),
        ]);

        $this->addBreadcrumb([
            'title' => 'Item #' . $orderItem->id,
            'url' => route('admin.pos-system.order-items.show', $id),
        ]);

        return $this->view('pos::backend.order-item.show', compact('orderItem'));
    }
} 