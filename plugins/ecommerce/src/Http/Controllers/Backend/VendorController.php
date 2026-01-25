<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Http\Controllers\BackendController;
use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Models\User;
use MojarCMS\CMS\Traits\ResourceController;
use Illuminate\Support\Facades\Validator;
use MojarCMS\CMS\Models\Role;
use MojarCMS\CMS\Models\Permission;
use Illuminate\Support\Facades\Log;
use Mojahid\Ecommerce\Http\Datatables\VendorDatatable;

class VendorController extends BackendController
{
    use ResourceController {
        getDataForForm as DataForForm;
        afterSave as tAfterSave;
    }

    protected string $viewPrefix = 'ecomm::backend.vendor';

    /**
     * Validator for store and update
     *
     * @param array $attributes
     * @param mixed ...$params
     * @return array
     */
    protected function validator(array $attributes, ...$params): array
    {
        $allStatus = array_keys(User::getAllStatus());
        $vendorStatuses = $this->getVendorStatuses();

        return [
            'name' => 'required|string|max:250',
            'password' => [
                Rule::requiredIf(
                    function () use ($attributes) {
                        return empty($attributes['id']);
                    }
                ),
                'confirmed'
            ],
            'avatar' => 'nullable|string|max:150',
            'email' => [
                'required_if:id,',
                'email',
                'max:150',
                Rule::modelUnique(User::class, 'email'),
            ],
            'status' => 'required|in:' . implode(',', $allStatus),
            'vendor_status' => 'nullable|in:' . implode(',', array_keys($vendorStatuses)),
        ];
    }

    /**
     * Get model resource
     *
     * @param mixed ...$params
     * @return string
     */
    protected function getModel(...$params): string
    {
        return User::class;
    }

    /**
     * Get title resource
     *
     * @param mixed ...$params
     * @return string
     */
    protected function getTitle(...$params): string
    {
        return trans('ecomm::content.vendors');
    }

    /**
     * Get data table resource
     *
     * @param mixed ...$params
     * @return VendorDatatable|DataTable
     */
    protected function getDataTable(...$params): VendorDatatable|DataTable
    {
        return new VendorDatatable();
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model);
        $data['allStatus'] = User::getAllStatus();
        $data['vendorStatuses'] = $this->getVendorStatuses();
        
        // Add vendor meta information
        $data['shop_name'] = $model->getMeta('shop_name');
        $data['business_phone'] = $model->getMeta('business_phone');
        $data['business_address'] = $model->getMeta('business_address');
        $data['vendor_status'] = $model->getMeta('user_status', 'approved');
        
        return $data;
    }

    protected function afterSave($data, $model, ...$params)
    {
        $this->tAfterSave($data, $model);
        
        // Handle vendor status changes
        $vendorStatus = Arr::get($data, 'vendor_status');
        if ($vendorStatus) {
            $originalStatus = $model->getMeta('user_status', 'approved');
            $model->setMeta('user_status', $vendorStatus);
            
            // Save the model to persist meta changes
            $model->save();
            
            // Send email notification for status change via hook
            // This hook will also handle role assignment/removal
            if ($originalStatus !== $vendorStatus) {
                Log::info('Triggering user.after_save hook from VendorController', [
                    'user_id' => $model->id,
                    'vendor_status' => $vendorStatus
                ]);
                
                do_action('user.after_save', $data, $model);
            }
        }
    }

    /**
     * After Save model
     *
     * @param array $data
     * @param Model $model
     * @throws ValidationException
     */
    protected function beforeSave(&$data, &$model, ...$params)
    {
        if ($password = Arr::get($data, 'password')) {
            Validator::make(
                $data,
                [
                    'password' => 'required|string|max:32|min:8|confirmed',
                    'password_confirmation' => 'required|string|max:32|min:8',
                ],
                [],
                [
                    'password' => trans('cms::app.password'),
                    'password_confirmation' => trans('cms::app.confirm_password'),
                ]
            )->validate();

            $model->setAttribute('password', Hash::make($password));
        }

        do_action('user.before_save', $data, $model);
    }

    /**
     * Get vendor statuses
     *
     * @return array
     */
    protected function getVendorStatuses(): array
    {
        return [
            'under_review' => trans('ecomm::content.under_review'),
            'approved' => trans('ecomm::content.approved'),
            'rejected' => trans('ecomm::content.rejected'),
            'suspended' => trans('ecomm::content.suspended'),
        ];
    }
} 