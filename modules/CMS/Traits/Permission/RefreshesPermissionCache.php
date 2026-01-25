<?php

namespace MojarCMS\CMS\Traits\Permission;

use MojarCMS\CMS\Support\Permission\PermissionRegistrar;

trait RefreshesPermissionCache
{
    public static function bootRefreshesPermissionCache()
    {
        static::saved(
            function () {
                app(PermissionRegistrar::class)->forgetCachedPermissions();
            }
        );

        static::deleted(
            function () {
                app(PermissionRegistrar::class)->forgetCachedPermissions();
            }
        );
    }
}
