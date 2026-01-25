<?php

namespace Mojahid\SupportTicket\Widgets;

use Mojahid\SupportTicket\Models\TicketSupport;

class SatisfactionWidget
{
    public static function render(): string
    {
        $ratedTickets = TicketSupport::whereNotNull('rating')->count();
        $totalClosedTickets = TicketSupport::where('status', 'closed')->count();
        
        $averageRating = TicketSupport::whereNotNull('rating')->avg('rating') ?? 0;
        $satisfactionRate = $totalClosedTickets > 0 ? round(($ratedTickets / $totalClosedTickets) * 100, 1) : 0;

        return view('sticket::widgets.satisfaction', compact(
            'averageRating',
            'satisfactionRate',
            'ratedTickets',
            'totalClosedTickets'
        ))->render();
    }
} 