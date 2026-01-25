<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\CMS\Contracts;

use MojarCMS\Backend\Models\Post;

/**
 * @see \MojarCMS\CMS\Support\Manager\PostManager
 */
interface PostManagerContract
{
    public function create(array $data, array $options = []): Post;

    public function update(array $data, int $id, array $options = []): Post;
}
