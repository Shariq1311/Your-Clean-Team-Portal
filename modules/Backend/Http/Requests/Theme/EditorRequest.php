<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Backend\Http\Requests\Theme;

use Illuminate\Foundation\Http\FormRequest;

class EditorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => 'required',
            'content' => 'required|string|max:10000',
        ];
    }
}
