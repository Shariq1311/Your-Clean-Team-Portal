<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use MojarCMS\CMS\Contracts\ConfigContract;

/**
 * @method static \MojarCMS\CMS\Models\Config setConfig($key, $value)
 * @method static string|array getConfig($key, $default = null)
 * @method static Collection all()
 * @see \MojarCMS\CMS\Support\Config
 */
class Config extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ConfigContract::class;
    }
}
