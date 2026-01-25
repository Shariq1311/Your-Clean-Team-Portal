<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Network\Traits;

use MojarCMS\Network\Facades\Network;

trait RootNetworkModel
{
    public function getConnectionName()
    {
        if (config('network.enable') && !Network::isRootSite()) {
            return Network::getCurrentSite()->root_connection;
        }

        return $this->connection;
    }
}
