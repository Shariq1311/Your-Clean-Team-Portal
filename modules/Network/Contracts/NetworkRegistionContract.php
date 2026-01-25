<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Network\Contracts;

interface NetworkRegistionContract
{
    public function init(): void;

    public function getCurrentSiteId(): ?int;

    public function getCurrentSite(): object;

    public function isRootSite($domain = null): bool;

    public function getCurrentDomain(): string;
}
