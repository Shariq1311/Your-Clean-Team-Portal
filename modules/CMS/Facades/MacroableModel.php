<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Facades;

use Illuminate\Support\Facades\Facade;
use MojarCMS\CMS\Contracts\MacroableModelContract;

/**
 * @method static void addMacro(string $model, string $name, \Closure $closure)
 * @method static bool removeMacro($model, string $name)
 * @method static bool modelHasMacro($model, $name)
 * @method static array modelsThatImplement($name)
 * @method static array macrosForModel($model)
 */
class MacroableModel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MacroableModelContract::class;
    }
}
