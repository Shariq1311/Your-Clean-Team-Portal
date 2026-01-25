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

use Illuminate\Support\Facades\Facade;
use MojarCMS\CMS\Contracts\XssCleanerContract;

/**
 * @method static string clean(string $value)
 *
 * @see \MojarCMS\CMS\Support\XssCleaner
 */
class XssCleaner extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return XssCleanerContract::class;
    }
}
