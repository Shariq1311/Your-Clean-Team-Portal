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

use MojarCMS\Network\Models\Site;

interface SiteManagerContract
{
    public function find(string|int|Site $site): ?NetworkSiteContract;

    public function create(string $subdomain, array $args = []): NetworkSiteContract;

    public function getCreater(): SiteCreaterContract;
}
