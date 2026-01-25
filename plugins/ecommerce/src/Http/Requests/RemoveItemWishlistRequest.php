<?php

namespace Mojahid\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemoveItemWishlistRequest extends FormRequest
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
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.exists' => trans('ecomm::content.product_not_found'),
        ];
    }
} 