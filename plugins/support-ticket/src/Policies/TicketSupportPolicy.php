<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace Mojahid\SupportTicket\Policies;   

use MojarCMS\CMS\Abstracts\ResourcePolicy;

class TicketSupportPolicy extends ResourcePolicy             
{
    protected string $resourceType = 'ticket-supports';     
}
