<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Backend\Http\Requests\Theme;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'theme' => [
                'bail',
                'string',
                'required',
            ]
        ];
    }
}
