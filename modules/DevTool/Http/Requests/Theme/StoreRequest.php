<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/Mojarcms
 * @author     Mojar Team
 * @link       https://Mojar.com
 * @license    GNU V2
 */

namespace MojarCMS\DevTool\Http\Requests\Theme;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'title' => ['required', 'string'],
        ];
    }
}
