<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Frontend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'post_id' => [
                'required',
                'numeric'
            ],
            'star' => [
                'required',
                'numeric',
                'min:0',
                'max:5'
            ]
        ];
    }
}
