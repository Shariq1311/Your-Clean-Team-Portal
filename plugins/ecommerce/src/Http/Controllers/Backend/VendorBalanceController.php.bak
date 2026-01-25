<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use MojarCMS\CMS\Traits\ResourceController;
use Illuminate\Support\Facades\Validator;
use MojarCMS\Backend\Http\Controllers\Backend\PageController;
use MojarCMS\CMS\Abstracts\DataTable;
use Mojahid\Ecommerce\Http\Datatables\VendorBalanceDatatable;
use Mojahid\Ecommerce\Models\VendorBalance;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;

class VendorBalanceController extends PageController
{
    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected string $viewPrefix = 'ecomm::backend.vendor-balance';

    protected function getDataTable(...$params): DataTable
    {
        return new VendorBalanceDatatable();
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
        return VendorBalance::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('ecomm::content.vendor_balance');
    }
}
