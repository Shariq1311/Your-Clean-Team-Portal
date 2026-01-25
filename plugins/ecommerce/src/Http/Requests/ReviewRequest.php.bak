<?php

namespace Mojahid\Ecommerce\Http\Requests;

use MojarCMS\Frontend\Http\Requests\CommentRequest;

class ReviewRequest extends CommentRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = parent::rules();
        
        // Add rating validation rule
        $rules['rating'] = 'required|integer|min:1|max:5';
        
        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return array_merge(
            parent::messages(),
            [
                'rating.required' => __('ecomm::content.rating_required'),
                'rating.integer' => __('ecomm::content.rating_integer'),
                'rating.min' => __('ecomm::content.rating_min'),
                'rating.max' => __('ecomm::content.rating_max'),
            ]
        );
    }
} 