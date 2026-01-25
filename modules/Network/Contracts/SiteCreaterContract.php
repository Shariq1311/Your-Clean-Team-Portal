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

interface SiteCreaterContract
{
    public function create(string $subdomain, array $args = []): Site;

    public function setupSite(Site $site);
}
