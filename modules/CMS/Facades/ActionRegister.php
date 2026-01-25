<?php

namespace MojarCMS\CMS\Facades;

use Illuminate\Support\Facades\Facade;
use MojarCMS\CMS\Contracts\ActionRegisterContract;

/**
 * @method static void init()
 * @method static void register(string|array $action)
 * @see \MojarCMS\CMS\Support\ActionRegister
 */
class ActionRegister extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ActionRegisterContract::class;
    }
}
