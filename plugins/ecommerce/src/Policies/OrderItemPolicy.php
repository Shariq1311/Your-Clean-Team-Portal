<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace Mojahid\Ecommerce\Policies;   

use MojarCMS\CMS\Abstracts\ResourcePolicy;

class OrderItemPolicy extends ResourcePolicy                
{
    protected string $resourceType = 'order_items'; 
}
