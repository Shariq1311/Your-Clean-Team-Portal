<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    Mojarcms/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojarcms.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class AddToWishlistRequest extends FormRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.exists' => 'Item not found or not available',
            'post_id.required' => 'Item ID is required',
            'type.in' => 'Invalid Item type specified'
        ];
    }

    protected function prepareForValidation()
    {
        Log::info('AddToWishlist Request Data:', $this->all());
    }
} 