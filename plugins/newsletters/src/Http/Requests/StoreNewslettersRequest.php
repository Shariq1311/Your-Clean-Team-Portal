<?php
/**
 * Mojar CMS - Laravel CMS for Your Project
 *
 * @package    Mojarcms/cms
 * @author     Mojar Team
 * @link       https://Mojarcms.com
 * @license    GNU V2
 */

namespace Mojahid\Newsletters\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewslettersRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'email' => ['required', 'string', 'email', 'max:250', 'unique:newsletters_subscribers,email']
        ];

        return $rules;
    }
}
