<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Contracts;

interface GlobalDataContract
{
    public function set($key, $value);

    public function get($key, $default = []);

    public function all(): array;
}
