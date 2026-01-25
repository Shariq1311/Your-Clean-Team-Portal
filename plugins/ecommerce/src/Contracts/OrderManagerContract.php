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

use MojarCMS\CMS\Models\User;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Supports\OrderInterface;

/**
 * @see \MojarCMS\Ecommerce\Supports\Manager\OrderManager
 */
interface OrderManagerContract
{
    public function find(Order|string|int $order): null|OrderInterface;

    public function createByCart(CartContract $cart, array $data, User $user): OrderInterface;

    public function createByItems(array $data, array $items, User $user): OrderInterface;
}
