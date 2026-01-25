<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    GNU General Public License v2.0
 */

namespace MojarCMS\CMS\Repositories\Abstracts;

use MojarCMS\CMS\Repositories\Contracts\RepositoryInterface;

abstract class Criteria
{
    public static function make(...$params): static
    {
        return new static(...$params);
    }

    abstract public function apply($model, RepositoryInterface $repository);
}
