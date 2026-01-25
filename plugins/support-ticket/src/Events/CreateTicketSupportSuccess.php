<?php
/**
 * Mojar CMS - Laravel CMS for Your Project
 *
 * @package    Mojarcms/Mojarcms
 * @author     Mojar Team
 * @link       https://Mojarcms.com
 * @license    GNU V2
 */

namespace Mojahid\SupportTicket\Events;

use Mojahid\SupportTicket\Models\TicketSupport;

class CreateTicketSupportSuccess
{
    public function __construct(public TicketSupport $ticketSupport)
    {
    }
}
