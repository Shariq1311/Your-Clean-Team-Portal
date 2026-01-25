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
 * @see \MojarCMS\CMS\Support\GoogleTranslate
 */
interface GoogleTranslate
{
    public function translate(string $source, string $target, string $text): string;

    public function withProxy(string|array $proxy): static;
}
