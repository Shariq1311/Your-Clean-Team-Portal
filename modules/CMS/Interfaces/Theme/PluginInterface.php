<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/Mojarcms
 * @author     Mojar Team
 * @link       https://Mojar.com
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Interfaces\Theme;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use MojarCMS\CMS\Support\Plugin;

/**
 * @see Plugin
 */
interface PluginInterface extends Arrayable
{
    public function getPath(string $path = ''): string;

    public function getInfo(bool $assoc = false): array|Collection;
}
