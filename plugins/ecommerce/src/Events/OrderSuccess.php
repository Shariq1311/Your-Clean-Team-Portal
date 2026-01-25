<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    Mojarcms/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojarcms.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Events;

use MojarCMS\CMS\Models\User;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Supports\OrderInterface;

class OrderSuccess
{
    public Order $order;
    public User $user;

    public function __construct(Order|OrderInterface $order, User $user)
    {
        if ($order instanceof OrderInterface) {
            $this->order = $order->getOrder();
        } else {
            $this->order = $order;
        }

        $this->user = $user;
    }
}
