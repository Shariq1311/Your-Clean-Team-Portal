<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Backend\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use MojarCMS\CMS\Models\User;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        $allStatus = array_keys(User::getAllStatus());

        return [
            'name' => [
                'bail',
                'required',
                'min:5',
            ],
            'avatar' => 'nullable|string|max:150',
            'status' => 'required|in:' . implode(',', $allStatus),
        ];
    }
}
