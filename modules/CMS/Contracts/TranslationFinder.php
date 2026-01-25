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

/**
 * @see \MojarCMS\CMS\Support\Translations\TranslationFinder
 */
interface TranslationFinder
{
    public function find(string $path, string $locale = 'en'): array;
}
