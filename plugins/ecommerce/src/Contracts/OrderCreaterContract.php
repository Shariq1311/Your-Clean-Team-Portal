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

interface OrderCreaterContract
{
    public function create(array $data, array $items, User $user): Order;
}
