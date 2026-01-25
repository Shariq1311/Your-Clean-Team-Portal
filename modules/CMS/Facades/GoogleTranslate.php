<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\CMS\Facades;

use Illuminate\Support\Facades\Facade;
use MojarCMS\CMS\Contracts\GoogleTranslate as GoogleTranslateContract;

class GoogleTranslate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return GoogleTranslateContract::class;
    }
}
