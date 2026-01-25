<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    GNU General Public License v2.0
 */

namespace MojarCMS\CMS\Console\Commands;

use Illuminate\Console\Command;
use MojarCMS\CMS\Version;

class VersionCommand extends Command
{
    protected $name = 'Mojarcms:version';

    public function handle()
    {
        echo Version::getVersion();
    }
}
