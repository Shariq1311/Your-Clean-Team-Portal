<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use MojarCMS\CMS\Traits\ResourceController;
use Illuminate\Support\Facades\Validator;
use MojarCMS\Backend\Http\Controllers\Backend\PageController;
use MojarCMS\CMS\Abstracts\DataTable;
use Mojahid\Ecommerce\Http\Datatables\VendorEarningDatatable;
use Mojahid\Ecommerce\Models\VendorEarning;
use Mojahid\Ecommerce\Models\VendorBalance;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VendorEarningController extends PageController
{
    use ResourceController;

    protected string $viewPrefix = 'ecomm::backend.vendor-earning';

    protected function getDataTable(...$params): DataTable
    {
        return new VendorEarningDatatable();
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
        return VendorEarning::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('ecomm::content.vendor_earning');
    }

    public function markCompleted(Request $request, $id): RedirectResponse
    {
        $earning = VendorEarning::findOrFail($id);
        
        if (!$earning->isPending()) {
            return $this->error([
                'message' => 'Earning is not in pending status'
            ]);
        }

        DB::beginTransaction();
        try {
            // Mark earning as completed
            $earning->markAsCompleted();
            
            // Update vendor balance - move from pending to available
            $vendorBalance = VendorBalance::findOrCreateForVendor($earning->vendor_id);
            $vendorBalance->completePendingEarning($earning->vendor_amount);
            
            DB::commit();
            
            return $this->success([
                'message' => trans('ecomm::content.earning_marked_completed')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([
                'message' => $e->getMessage()
            ]);
        }
    }
}
