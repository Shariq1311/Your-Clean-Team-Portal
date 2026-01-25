<?php

namespace Mojahid\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoveToCartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'post_id' => [
                'bail',
                'required',
                'integer'
            ],
            'type' => [
                'bail',
                'required',
                'string'
            ],
            'quantity' => [
                'bail',
                'sometimes',
                'integer',
                'min:1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.exists' => 'Item not found or not available',
            'post_id.required' => 'Item ID is required',
            'quantity.min' => 'Quantity must be at least 1',
            'type.in' => 'Invalid Item type specified'
        ];
    }
} 