<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    Mojarcms/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojarcms.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Contracts;

use Mojahid\Ecommerce\Models\Cart;

interface CartManagerContract
{
    public function find(string|Cart $cart = null): CartContract;

    public function getCodeCurrentCart(): string;
}
