<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Traits\Models;

use Illuminate\Support\Str;

trait UseCodeColumn
{
    public static function generateCode(): string
    {
        do {
            $code = Str::random(15);
        } while (static::withoutGlobalScopes()->where('code', $code)->exists());

        return $code;
    }

    protected static function bootUseCodeColumn(): void
    {
        /**
         * Listen for the creating event on the user model.
         * Sets the 'id' to a UUID using Str::uuid() on the instance being created
         */
        static::creating(
            function ($model) {
                if (!$model->getAttribute('code')) {
                    $model->setAttribute('code', static::generateCode());
                }
            }
        );
    }
}
