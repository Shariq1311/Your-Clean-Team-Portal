<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com/cms
 * @license    MIT
 */

namespace MojarCMS\Frontend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'current_password' => 'required',
            'password' => 'required|confirmed|string|max:32|min:6',
        ];
    }
}
