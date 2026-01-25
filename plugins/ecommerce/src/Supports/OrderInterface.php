<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    Mojarcms/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojarcms.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Supports;

use Illuminate\Support\Collection;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Contracts\Payment\PaymentMethodInterface;

interface OrderInterface
{
    public function purchase(): PaymentMethodInterface;

    public function completed(?array $input): bool;

    public function getItems(): Collection;

    public function getOrder(): Order;

    public function getPaymentRedirectURL(): string;
}
