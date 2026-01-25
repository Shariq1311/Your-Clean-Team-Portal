<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Support\Validators;

class DomainValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        return filter_var($value, FILTER_VALIDATE_DOMAIN);
    }
}
