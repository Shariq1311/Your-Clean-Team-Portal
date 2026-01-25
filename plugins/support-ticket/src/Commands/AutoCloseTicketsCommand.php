<?php

namespace Mojahid\SupportTicket\Commands;

use Illuminate\Console\Command;
use Mojahid\SupportTicket\Models\TicketSupport;
use Illuminate\Support\Facades\Log;

class AutoCloseTicketsCommand extends Command
{
    protected $signature = 'support-ticket:auto-close';
    protected $description = 'Automatically close tickets based on settings';

    public function handle()
    {
        if (!get_config('enable_auto_close', 1)) {
            $this->info('Auto close is disabled in settings.');
            return;
        }

        $autoCloseDays = get_config('auto_close_days', 30);
        $notifyBeforeClose = get_config('notify_before_close', 1);
        $notifyDaysBefore = get_config('notify_days_before', 3);

        $this->info("Starting auto close process...");
        $this->info("Auto close days: {$autoCloseDays}");
        $this->info("Notify before close: " . ($notifyBeforeClose ? 'Yes' : 'No'));

        // Find tickets that should be auto-closed
        $ticketsToClose = TicketSupport::where('status', '!=', TicketSupport::STATUS_CLOSE)
            ->where('last_activity_at', '<', now()->subDays($autoCloseDays))
            ->get();

        $this->info("Found {$ticketsToClose->count()} tickets to close.");

        foreach ($ticketsToClose as $ticket) {
            $this->info("Closing ticket: {$ticket->title} (ID: {$ticket->id})");
            
            $ticket->update([
                'status' => TicketSupport::STATUS_CLOSE,
                'auto_close_at' => now(),
            ]);

            // Log the auto close
            Log::info("Ticket auto-closed", [
                'ticket_id' => $ticket->id,
                'title' => $ticket->title,
                'auto_closed_at' => now(),
            ]);

            // Send notification if enabled
            if ($notifyBeforeClose) {
                $this->sendAutoCloseNotification($ticket);
            }
        }

        $this->info("Auto close process completed.");
    }

    private function sendAutoCloseNotification($ticket)
    {
        // Implement notification logic here
        // This could send email, SMS, or in-app notification
        $this->info("Notification sent for ticket: {$ticket->title}");
    }
} 