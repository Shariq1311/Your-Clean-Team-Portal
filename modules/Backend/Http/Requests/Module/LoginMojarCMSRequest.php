<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Backend\Http\Requests\Module;

use Illuminate\Foundation\Http\FormRequest;

class LoginMojarCMSRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'bail',
                'required',
                'string',
                'email'
            ],
            'password' => [
                'bail',
                'required',
                'string',
            ],
        ];
    }
}
