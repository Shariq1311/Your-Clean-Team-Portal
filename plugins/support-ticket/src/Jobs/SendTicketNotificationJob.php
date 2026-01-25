<?php

namespace Mojahid\SupportTicket\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mojahid\SupportTicket\Models\TicketSupport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendTicketNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ticket;
    public $notificationType;
    public $recipients;

    public function __construct(TicketSupport $ticket, string $notificationType, array $recipients = [])
    {
        $this->ticket = $ticket;
        $this->notificationType = $notificationType;
        $this->recipients = $recipients;
    }

    public function handle()
    {
        try {
            switch ($this->notificationType) {
                case 'new_ticket':
                    $this->sendNewTicketNotification();
                    break;
                case 'ticket_reply':
                    $this->sendTicketReplyNotification();
                    break;
                case 'ticket_closed':
                    $this->sendTicketClosedNotification();
                    break;
                case 'ticket_escalated':
                    $this->sendTicketEscalatedNotification();
                    break;
                case 'auto_close_warning':
                    $this->sendAutoCloseWarningNotification();
                    break;
                default:
                    Log::warning("Unknown notification type: {$this->notificationType}");
            }
        } catch (\Exception $e) {
            Log::error("Failed to send ticket notification", [
                'ticket_id' => $this->ticket->id,
                'notification_type' => $this->notificationType,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function sendNewTicketNotification()
    {
        if (!get_config('notify_new_ticket', 1)) {
            return;
        }

        $template = get_config('new_ticket_template', 'New ticket #{ticket_id} has been created by {customer_name}. Subject: {ticket_subject}');
        $message = $this->replacePlaceholders($template);

        // Send to staff
        $this->sendStaffNotification($message, 'New Ticket Created');
    }

    private function sendTicketReplyNotification()
    {
        if (!get_config('notify_ticket_reply', 1)) {
            return;
        }

        $template = get_config('ticket_reply_template', 'Ticket #{ticket_id} has received a new reply from {replier_name}.');
        $message = $this->replacePlaceholders($template);

        // Send to customer and staff
        $this->sendCustomerNotification($message, 'Ticket Reply');
        $this->sendStaffNotification($message, 'Ticket Reply');
    }

    private function sendTicketClosedNotification()
    {
        if (!get_config('notify_status_change', 1)) {
            return;
        }

        $template = get_config('ticket_closed_template', 'Ticket #{ticket_id} has been closed by {closed_by}.');
        $message = $this->replacePlaceholders($template);

        // Send to customer
        $this->sendCustomerNotification($message, 'Ticket Closed');
    }

    private function sendTicketEscalatedNotification()
    {
        if (!get_config('notify_escalation', 1)) {
            return;
        }

        $message = "Ticket #{$this->ticket->id} has been escalated to {$this->ticket->escalated_to}.";
        
        // Send to escalated level
        $this->sendEscalationNotification($message, 'Ticket Escalated');
    }

    private function sendAutoCloseWarningNotification()
    {
        $daysBefore = get_config('notify_days_before', 3);
        $message = "Ticket #{$this->ticket->id} will be automatically closed in {$daysBefore} days if no activity occurs.";
        
        // Send to customer
        $this->sendCustomerNotification($message, 'Auto Close Warning');
    }

    private function replacePlaceholders($template)
    {
        return str_replace(
            [
                '{ticket_id}',
                '{customer_name}',
                '{ticket_subject}',
                '{replier_name}',
                '{closed_by}',
            ],
            [
                $this->ticket->id,
                $this->ticket->user?->name ?? 'Unknown',
                $this->ticket->title,
                auth()->user()?->name ?? 'Staff',
                auth()->user()?->name ?? 'System',
            ],
            $template
        );
    }

    private function sendStaffNotification($message, $subject)
    {
        // Get staff emails from settings or user roles
        $staffEmails = $this->getStaffEmails();
        
        foreach ($staffEmails as $email) {
            // Send email notification
            // Mail::to($email)->send(new TicketNotificationMail($message, $subject));
            Log::info("Staff notification sent", ['email' => $email, 'subject' => $subject]);
        }
    }

    private function sendCustomerNotification($message, $subject)
    {
        if ($this->ticket->user?->email) {
            // Send email notification
            // Mail::to($this->ticket->user->email)->send(new TicketNotificationMail($message, $subject));
            Log::info("Customer notification sent", ['email' => $this->ticket->user->email, 'subject' => $subject]);
        }
    }

    private function sendEscalationNotification($message, $subject)
    {
        // Send to escalated level (supervisor, manager, admin)
        $escalatedTo = $this->ticket->escalated_to;
        $escalatedEmails = $this->getEscalatedEmails($escalatedTo);
        
        foreach ($escalatedEmails as $email) {
            // Send email notification
            // Mail::to($email)->send(new TicketNotificationMail($message, $subject));
            Log::info("Escalation notification sent", ['email' => $email, 'subject' => $subject]);
        }
    }

    private function getStaffEmails()
    {
        // Get staff emails based on roles or settings
        return ['staff@example.com']; // Replace with actual logic
    }

    private function getEscalatedEmails($level)
    {
        // Get emails for escalated level
        return ['escalated@example.com']; // Replace with actual logic
    }
} 