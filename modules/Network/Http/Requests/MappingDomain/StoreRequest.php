<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Network\Http\Requests\MappingDomain;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use MojarCMS\Network\Models\DomainMapping;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'domain' => [
                'bail',
                'required',
                'max:100',
                'min:4',
                "regex:/(^[a-z0-9\-\.]+)/",
                Rule::modelUnique(
                    DomainMapping::class,
                    'domain'
                )
            ],
        ];
    }
}
