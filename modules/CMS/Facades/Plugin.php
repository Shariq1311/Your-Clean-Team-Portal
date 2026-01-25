<?php

namespace MojarCMS\CMS\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \MojarCMS\CMS\Support\Plugin[] all(bool $collection = false)
 * @method static \MojarCMS\CMS\Support\Plugin|null find(string $name)
 * @method static delete(string $plugin)
 * @method static enable(string $plugin)
 * @method static disable(string $plugin)
 * @method static getPath(string $path = '')
 * @method static string assets(string $plugin, string $path)
 * @method static bool isEnabled(string $name)
 *
 * @see \MojarCMS\CMS\Support\LocalPluginRepository
 */
class Plugin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'plugins';
    }
}
