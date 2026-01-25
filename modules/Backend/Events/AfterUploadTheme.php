<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Backend\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AfterUploadTheme
{
    use Dispatchable;
    use SerializesModels;

    protected array $theme;

    public function __construct(array $theme)
    {
        $this->theme = $theme;
    }
}
