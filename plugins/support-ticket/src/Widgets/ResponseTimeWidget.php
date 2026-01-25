<?php

namespace Mojahid\SupportTicket\Widgets;

use Mojahid\SupportTicket\Models\TicketSupport;
use Mojahid\SupportTicket\Models\TicketSupportComment;
use Carbon\Carbon;

class ResponseTimeWidget
{
    public static function render(): string
    {
        // Calculate average response time
        $ticketsWithReplies = TicketSupport::whereHas('comments')
            ->with(['comments' => function($query) {
                $query->orderBy('created_at', 'asc');
            }])
            ->get();

        $totalResponseTime = 0;
        $ticketsCounted = 0;

        foreach ($ticketsWithReplies as $ticket) {
            $firstReply = $ticket->comments->first();
            if ($firstReply) {
                $responseTime = Carbon::parse($ticket->created_at)
                    ->diffInHours($firstReply->created_at);
                $totalResponseTime += $responseTime;
                $ticketsCounted++;
            }
        }

        $averageResponseTime = $ticketsCounted > 0 ? round($totalResponseTime / $ticketsCounted, 1) : 0;

        return view('sticket::widgets.response_time', compact('averageResponseTime'))->render();
    }
} 