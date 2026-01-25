<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Translation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddLanguageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'locale' => [
                'required',
                'string',
                'max:5'
            ],
        ];
    }
}
