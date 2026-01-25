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

use MojarCMS\CMS\Models\User;

interface NetworkSiteContract
{
    public function getLoginUrl(User $user): string;
}
