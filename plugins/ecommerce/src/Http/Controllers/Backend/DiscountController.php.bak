<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use MojarCMS\CMS\Http\Controllers\BackendController;
use MojarCMS\CMS\Traits\ResourceController;
use Mojahid\Ecommerce\Http\Datatables\DiscountDatatable;
use Mojahid\Ecommerce\Models\Discount;
use MojarCMS\Backend\Models\Post;
use MojarCMS\Backend\Models\Taxonomy;

class DiscountController extends BackendController
{
    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected string $viewPrefix = 'ecomm::backend.discount';

    protected function getDataTable(...$params): DiscountDatatable
    {
        return new DiscountDatatable();
    }

    protected function validator(array $attributes, ...$params): \Illuminate\Validation\Validator
    {
        $discountId = $params[0] ?? null;
        
        return Validator::make(
            $attributes,
            [
                'title' => 'required|string|max:250',
                'code' => [
                    'required',
                    'string',
                    'max:50',
                    'alpha_dash',
                    Rule::unique('ecomm_discounts', 'code')->ignore($discountId)
                ],
                'description' => 'nullable|string',
                'type' => 'required|in:percentage,fixed',
                'value' => 'required|numeric|min:0|max:99999.99',
                'minimum_amount' => 'nullable|numeric|min:0',
                'maximum_discount' => 'nullable|numeric|min:0',
                'usage_limit' => 'nullable|integer|min:1',
                'usage_limit_per_customer' => 'nullable|integer|min:1',
                'is_active' => 'boolean',
                'free_shipping' => 'boolean',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'applicable_products' => 'nullable|array',
                'applicable_products.*' => 'integer|exists:posts,id',
                'applicable_categories' => 'nullable|array',
                'applicable_categories.*' => 'integer|exists:taxonomies,id',
                'excluded_products' => 'nullable|array',
                'excluded_products.*' => 'integer|exists:posts,id',
                'excluded_categories' => 'nullable|array',
                'excluded_categories.*' => 'integer|exists:taxonomies,id',
            ],
            [
                'code.alpha_dash' => 'The code may only contain letters, numbers, dashes and underscores.',
                'end_date.after_or_equal' => 'The end date must be after or equal to start date.',
                'value.max' => 'The value may not be greater than 99,999.99.',
            ]
        );
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model, ...$params);
        
        // Get products for selection
        $data['products'] = Post::where('type', 'products')
            ->where('status', 'publish')
            ->select('id', 'title')
            ->orderBy('title')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->id => $item->title];
            })->toArray();

        // Get categories for selection
        $data['categories'] = Taxonomy::where('taxonomy', 'categories')
            ->where('post_type', 'products')
            ->select('id', 'name')
            ->orderBy('name')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->id => $item->name];
            })->toArray();

        $data['discountTypes'] = Discount::getTypes();
        
        return $data;
    }

    protected function beforeSave(array &$data, $model, ...$params): void
    {
        // Convert code to uppercase
        $data['code'] = strtoupper($data['code']);
        
        // Handle boolean fields
        $data['is_active'] = isset($data['is_active']) ? (bool) $data['is_active'] : true;
        $data['free_shipping'] = isset($data['free_shipping']) ? (bool) $data['free_shipping'] : false;
        
        // Handle array fields
        $data['applicable_products'] = $data['applicable_products'] ?? [];
        $data['applicable_categories'] = $data['applicable_categories'] ?? [];
        $data['excluded_products'] = $data['excluded_products'] ?? [];
        $data['excluded_categories'] = $data['excluded_categories'] ?? [];
        
        // Clear empty arrays
        foreach (['applicable_products', 'applicable_categories', 'excluded_products', 'excluded_categories'] as $field) {
            if (empty($data[$field])) {
                $data[$field] = null;
            }
        }
        
        // Validate percentage value
        if ($data['type'] === 'percentage' && $data['value'] > 100) {
            $data['value'] = 100;
        }
    }

    protected function afterSave($data, $model, ...$params): void
    {
        do_action('discount.after_save', $model, $data);
    }

    public function toggleStatus(Request $request, $id): JsonResponse
    {
        try {
            $discount = Discount::findOrFail($id);
            $discount->update(['is_active' => !$discount->is_active]);
            
            $status = $discount->is_active ? 'activated' : 'deactivated';
            
            return $this->success([
                'message' => "Discount has been {$status} successfully",
                'status' => $discount->is_active
            ]);
        } catch (\Exception $e) {
            return $this->error([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function validateCode(Request $request): JsonResponse
    {
        $code = strtoupper($request->input('code'));
        $excludeId = $request->input('exclude_id');
        
        $query = Discount::where('code', $code);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        
        $exists = $query->exists();
        
        return response()->json([
            'valid' => !$exists,
            'message' => $exists ? 'This discount code is already taken' : 'Discount code is available'
        ]);
    }

    public function duplicate(Request $request, $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            $original = Discount::findOrFail($id);
            $duplicate = $original->replicate();
            
            // Modify duplicated data
            $duplicate->title = $original->title . ' (Copy)';
            $duplicate->code = $original->code . '_COPY_' . time();
            $duplicate->used_count = 0;
            $duplicate->is_active = false;
            
            $duplicate->save();
            
            DB::commit();
            
            return $this->success([
                'message' => 'Discount duplicated successfully',
                'redirect' => route('admin.discounts.edit', $duplicate->id)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function resetUsage(Request $request, $id): JsonResponse
    {
        try {
            $discount = Discount::findOrFail($id);
            $discount->update(['used_count' => 0]);
            
            return $this->success([
                'message' => 'Usage count has been reset successfully'
            ]);
        } catch (\Exception $e) {
            return $this->error([
                'message' => $e->getMessage()
            ]);
        }
    }

    protected function getModel(...$params): string
    {
        return Discount::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('ecomm::content.discounts');
    }

    public function getFieldName(): string
    {
        return 'id';
    }

    public function create()
    {
        $model = new Discount();
        $data = $this->getDataForForm($model);
        
        return view("{$this->viewPrefix}.form", compact('model') + $data);
    }

    public function edit($id)
    {
        $model = Discount::findOrFail($id);
        $data = $this->getDataForForm($model);
        
        return view("{$this->viewPrefix}.form", compact('model') + $data);
    }

    public function test()
    {
        // Simple test method to verify system is working
        $discountTypes = Discount::getTypes();
        
        return response()->json([
            'success' => true,
            'discount_types' => $discountTypes,
            'message' => 'Discount system is working properly'
        ]);
    }
} 