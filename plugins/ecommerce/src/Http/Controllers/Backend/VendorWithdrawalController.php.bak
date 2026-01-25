<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use MojarCMS\CMS\Traits\ResourceController;
use Illuminate\Support\Facades\Validator;
use MojarCMS\Backend\Http\Controllers\Backend\PageController;
use MojarCMS\CMS\Abstracts\DataTable;
use Mojahid\Ecommerce\Http\Datatables\VendorWithdrawalDatatable;
use Mojahid\Ecommerce\Models\VendorWithdrawal;
use Mojahid\Ecommerce\Models\VendorBalance;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VendorWithdrawalController extends PageController
{
    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected string $viewPrefix = 'ecomm::backend.vendor-withdrawal';

    protected function getDataTable(...$params): DataTable
    {
        return new VendorWithdrawalDatatable();
    }

    protected function validator(array $attributes, ...$params): ValidatorContract
    {
        return Validator::make(
            $attributes,
            [
                'vendor_id' => 'required|exists:users,id',
                'amount' => [
                    'required',
                    'numeric',
                    'min:10.00',
                    function ($attribute, $value, $fail) {
                        // Check if vendor has sufficient balance
                        if (Auth::check() && Auth::user()->hasRole('vendor')) {
                            $vendorBalance = VendorBalance::findOrCreateForVendor(Auth::id());
                            if ($vendorBalance->getAvailableBalance() < $value) {
                                $fail('Insufficient balance. Available balance: $' . number_format($vendorBalance->getAvailableBalance(), 2));
                            }
                        }
                    }
                ],
                'currency_code' => 'required|string|max:10',
                'payment_method' => 'required|string|max:100',
                'payment_details' => 'nullable|string',
                'notes' => 'nullable|string|max:500',
                'status' => 'nullable|in:pending,approved,rejected,completed',
            ]
        );
    }

    protected function getModel(...$params): string
    {
        return VendorWithdrawal::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('ecomm::content.vendor_withdrawal');
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = [
            'model' => $model,
        ];
        
        // Add payment methods for selection
        $data['paymentMethods'] = [
            'bank_transfer' => 'Bank Transfer',
            'paypal' => 'PayPal',
            'stripe' => 'Stripe',
            'check' => 'Check',
            'cash' => 'Cash',
            'other' => 'Other'
        ];
        
        // Add status options
        $data['statusOptions'] = [
            'pending' => 'Pending',
            'approved' => 'Approved', 
            'rejected' => 'Rejected',
            'completed' => 'Completed'
        ];
        
        // Add currency options
        $data['currencyOptions'] = [
            'USD' => 'USD - US Dollar',
            'EUR' => 'EUR - Euro',
            'GBP' => 'GBP - British Pound',
            'CAD' => 'CAD - Canadian Dollar',
            'AUD' => 'AUD - Australian Dollar'
        ];
        
        // Auto-fill vendor_id if user is vendor
        if (Auth::check() && Auth::user()->hasRole('vendor')) {
            $data['model']->vendor_id = Auth::id();
        } else {
            // For admin users, provide vendors list
            $data['vendors'] = \MojarCMS\Backend\Models\User::whereHas('roles', function($query) {
                $query->where('name', 'vendor');
            })->get(['id', 'name', 'email']);
        }
        
        // Set default currency
        if (!$data['model']->currency_code) {
            $data['model']->currency_code = 'USD';
        }
        
        // Set default status for new withdrawals
        if (!$data['model']->status) {
            $data['model']->status = 'pending';
        }
        
        return $data;
    }

    protected function beforeSave(array &$data, $model, ...$params): void
    {
        // Auto-assign vendor_id if user is vendor
        if (Auth::check() && Auth::user()->hasRole('vendor')) {
            $data['vendor_id'] = Auth::id();
        }
        
        // Set default status for new withdrawals
        if (!$model->id && !isset($data['status'])) {
            $data['status'] = 'pending';
        }
        
        // Set default currency if not provided
        if (!isset($data['currency_code'])) {
            $data['currency_code'] = 'USD';
        }
    }

    public function approve(Request $request, $id): RedirectResponse
    {
        $withdrawal = VendorWithdrawal::findOrFail($id);
        
        if (!$withdrawal->isPending()) {
            return $this->error([
                'message' => 'Withdrawal is not in pending status'
            ]);
        }

        DB::beginTransaction();
        try {
            // Check if vendor has sufficient balance
            $vendorBalance = VendorBalance::findOrCreateForVendor($withdrawal->vendor_id);
            if ($vendorBalance->getAvailableBalance() < $withdrawal->amount) {
                return $this->error([
                    'message' => 'Insufficient balance for withdrawal'
                ]);
            }
            
            // Approve the withdrawal
            $withdrawal->approve(Auth::id());
            
            // Deduct amount from vendor balance
            $vendorBalance->addWithdrawal($withdrawal->amount);
            
            DB::commit();
            
            return $this->success([
                'message' => trans('ecomm::content.withdrawal_approved')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function reject(Request $request, $id): RedirectResponse
    {
        $withdrawal = VendorWithdrawal::findOrFail($id);
        
        if (!$withdrawal->isPending()) {
            return $this->error([
                'message' => 'Withdrawal is not in pending status'
            ]);
        }

        DB::beginTransaction();
        try {
            $notes = $request->input('notes', 'Withdrawal rejected by admin');
            $withdrawal->reject(Auth::id(), $notes);
            
            // No need to refund since withdrawal was never deducted from balance
            // The amount remains in vendor's available balance
            
            DB::commit();
            
            return $this->success([
                'message' => trans('ecomm::content.withdrawal_rejected')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function complete(Request $request, $id): RedirectResponse
    {
        $withdrawal = VendorWithdrawal::findOrFail($id);
        
        if (!$withdrawal->isApproved()) {
            return $this->error([
                'message' => 'Withdrawal must be approved before completion'
            ]);
        }

        DB::beginTransaction();
        try {
            $withdrawal->complete(Auth::id());
            
            DB::commit();
            
            return $this->success([
                'message' => trans('ecomm::content.withdrawal_completed')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([
                'message' => $e->getMessage()
            ]);
        }
    }
}
