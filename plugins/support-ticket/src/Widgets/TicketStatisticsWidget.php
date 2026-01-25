<?php

namespace Mojahid\SupportTicket\Widgets;

use Mojahid\SupportTicket\Models\TicketSupport;

class TicketStatisticsWidget
{
    public static function render(): string
    {
        $totalTickets = TicketSupport::count();
        $openTickets = TicketSupport::where('status', 'open')->count();
        $closedTickets = TicketSupport::where('status', 'closed')->count();
        $urgentTickets = TicketSupport::where('priority', 'urgent')->count();

        return view('sticket::widgets.ticket_statistics', compact(
            'totalTickets',
            'openTickets',
            'closedTickets',
            'urgentTickets'
        ))->render();
    }
} 