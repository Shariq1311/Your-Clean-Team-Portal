<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com/
 * @license    MIT
 */

namespace MojarCMS\CMS\Contracts;

use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Support\FileManager\Media;

interface MediaManagerContract
{
    public function find(string|int|Model $media, string $type = 'file'): null|Media;

    public function findFile(string|int|Model $file): null|Media;

    public function findFolder(string|int|Model $folder): null|Media;
}
