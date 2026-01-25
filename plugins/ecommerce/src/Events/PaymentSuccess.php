<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    Mojarcms/cms
 * @author     MojarCMS Team <admin@Mojarcms.com>
 * @link       https://Mojarcms.com
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Events;

use Mojahid\Ecommerce\Models\Order;

class PaymentSuccess
{
    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
