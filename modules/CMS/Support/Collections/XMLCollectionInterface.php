<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com/cms
 * @license    MIT
 */

namespace MojarCMS\CMS\Support\Collections;

use Illuminate\Support\Collection;

interface XMLCollectionInterface
{
    public function getCollection($filePath): Collection;
}
