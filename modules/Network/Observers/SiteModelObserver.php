<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Network\Observers;

use MojarCMS\Network\Models\Site;

class SiteModelObserver
{
    /**
     * Handle the Model "deleted" event.
     *
     * @param Site $model
     * @return void
     * @throws \Exception
     */
    public function updated(Site $model): void
    {
        cache()->pull(md5($model->getFullDomain()));
    }

    /**
     * Handle the Model "deleted" event.
     *
     * @param Site $model
     * @return void
     * @throws \Exception
     */
    public function deleted(Site $model): void
    {
        cache()->pull(md5($model->getFullDomain()));
    }
}
