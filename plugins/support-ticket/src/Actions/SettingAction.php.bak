<?php

namespace Mojahid\SupportTicket\Actions;

use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;
use Illuminate\Http\Request;

class SettingAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerConfigs']
        );

        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerEmailTemplates']
        );

        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerDashboardWidgets']
        );

        $this->registerInitActions();
    }

    private function registerInitActions(): void
    {
        $this->addAction(
            Action::PERMISSION_INIT,
            [$this, 'addPermissions']
        );
    }

    public function addPermissions(): void
    {
        HookAction::registerResourcePermissions(
            'ticket-supports',
            trans('sticket::content.ticket_supports')
        );

        HookAction::registerResourcePermissions(
            'ticket-supports-types',
            trans('sticket::content.ticket_supports_types')
        );

        HookAction::registerResourcePermissions(
            'ticket-supports-settings',
            trans('sticket::content.ticket_supports_settings')
        );
    }

    public function registerConfigs(): void
    {
        HookAction::registerConfig([
            // General Settings
            'support_email',
            'support_phone',
            'support_working_hours',
            'support_welcome_message',
            'tickets_per_page',
            'enable_attachments',
            'max_attachment_size',
            'allowed_attachment_types',
            
            // Automation Settings
            'enable_auto_close',
            'auto_close_days',
            'notify_before_close',
            'notify_days_before',
            'enable_escalation',
            'escalation_hours',
            'escalation_level',
            'enable_auto_assignment',
            'assignment_method',
            'auto_assignment_rules',
            
            // Notification Settings
            'notify_new_ticket',
            'notify_ticket_reply',
            'notify_status_change',
            'notify_assignment',
            'notify_escalation',
            'notify_staff_dashboard',
            'notify_staff_email',
            'notify_staff_sms',
            'notification_interval',
            
            // Email Templates
            'new_ticket_template',
            'ticket_reply_template',
            'ticket_closed_template',
            'ticket_assigned_template',
            'ticket_escalated_template',
            
            // Rating & Feedback
            'enable_rating',
            'rating_scale',
            'require_rating',
            'rating_reminder_days',
            'rate_response_time',
            'rate_solution_quality',
            'rate_staff_courtesy',
            'rate_overall_satisfaction',
            'enable_feedback',
            'rating_thank_you_message',
            'low_rating_message',
            
            // Editor Settings
            'editor_type',
            'enable_rich_editor',
            'enable_file_upload',
            'enable_image_upload',
            'enable_bold_italic',
            'enable_lists',
            'enable_links',
            'enable_code_blocks',
            'editor_toolbar_buttons',
            'editor_height',
            'editor_custom_css',
            
            // SMS Settings
            'enable_sms_notifications',
            'sms_provider',
            'sms_api_key',
            'sms_api_secret',
            'sms_from_number',
            
            // SLA Settings
            'enable_sla',
            'sla_response_time',
            'sla_resolution_time',
            'sla_escalation_time',
            'sla_working_hours',
            'sla_holidays',
            
            // Dashboard Widgets
            'show_ticket_statistics',
            'show_response_time_widget',
            'show_satisfaction_widget',
            'show_agent_performance',
            'show_ticket_trends',
            
            // Reports
            'enable_reports',
            'report_retention_days',
            'auto_generate_reports',
            'report_frequency',
            'report_recipients',
            
            // Integration Settings
            'enable_api',
            'api_rate_limit',
            'enable_webhook',
            'webhook_url',
            'webhook_secret',
        ]);
    }

    public function addSettingPage(): void
    {
        HookAction::addSettingForm(
            'support-ticket',
            [
                'name' => trans('sticket::content.support_ticket'),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-headset"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 14v-3a8 8 0 1 1 16 0v3"></path><path d="M18 19v3"></path><path d="M6 19v3"></path><path d="M12 14v-4"></path><path d="M8 17h.01"></path><path d="M16 17h.01"></path></svg>',
                'menu_position' => 50,
            ]
        );
    }

    public function registerEmailTemplates(): void
    {
        HookAction::registerEmailTemplate('new_ticket', [
            'name' => 'New Ticket Notification',
            'subject' => 'New Support Ticket: {ticket_id}',
            'content' => $this->getNewTicketTemplate(),
        ]);

        HookAction::registerEmailTemplate('ticket_reply', [
            'name' => 'Ticket Reply Notification',
            'subject' => 'Reply to Ticket: {ticket_id}',
            'content' => $this->getTicketReplyTemplate(),
        ]);

        HookAction::registerEmailTemplate('ticket_closed', [
            'name' => 'Ticket Closed Notification',
            'subject' => 'Ticket Closed: {ticket_id}',
            'content' => $this->getTicketClosedTemplate(),
        ]);

        HookAction::registerEmailTemplate('ticket_assigned', [
            'name' => 'Ticket Assignment Notification',
            'subject' => 'Ticket Assigned: {ticket_id}',
            'content' => $this->getTicketAssignedTemplate(),
        ]);
    }

    public function registerDashboardWidgets(): void
    {
        HookAction::registerWidget('ticket_statistics', [
            'name' => 'Ticket Statistics',
            'description' => 'Display ticket statistics on dashboard',
            'callback' => [\Mojahid\SupportTicket\Widgets\TicketStatisticsWidget::class, 'render'],
        ]);

        HookAction::registerWidget('response_time_widget', [
            'name' => 'Response Time Widget',
            'description' => 'Display average response time',
            'callback' => [\Mojahid\SupportTicket\Widgets\ResponseTimeWidget::class, 'render'],
        ]);

        HookAction::registerWidget('satisfaction_widget', [
            'name' => 'Customer Satisfaction',
            'description' => 'Display customer satisfaction ratings',
            'callback' => [\Mojahid\SupportTicket\Widgets\SatisfactionWidget::class, 'render'],
        ]);
    }

    public function saveSetting(Request $request)
    {
        $data = $request->all();
        
        // Remove CSRF token and method
        unset($data['_token'], $data['_method']);
        
        foreach ($data as $key => $value) {
            set_config($key, $value);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => trans('cms::app.save_successfully')
        ]);
    }

    private function getNewTicketTemplate(): string
    {
        return '
        <h2>New Support Ticket</h2>
        <p>Hello {agent_name},</p>
        <p>A new support ticket has been created:</p>
        <ul>
            <li><strong>Ticket ID:</strong> {ticket_id}</li>
            <li><strong>Subject:</strong> {ticket_subject}</li>
            <li><strong>Customer:</strong> {customer_name}</li>
            <li><strong>Priority:</strong> {priority}</li>
            <li><strong>Created:</strong> {created_at}</li>
        </ul>
        <p><strong>Description:</strong></p>
        <p>{ticket_content}</p>
        <p><a href="{ticket_url}">View Ticket</a></p>
        ';
    }

    private function getTicketReplyTemplate(): string
    {
        return '
        <h2>Ticket Reply</h2>
        <p>Hello {customer_name},</p>
        <p>Your ticket has received a reply:</p>
        <ul>
            <li><strong>Ticket ID:</strong> {ticket_id}</li>
            <li><strong>Subject:</strong> {ticket_subject}</li>
            <li><strong>Replied by:</strong> {agent_name}</li>
            <li><strong>Date:</strong> {reply_date}</li>
        </ul>
        <p><strong>Reply:</strong></p>
        <p>{reply_content}</p>
        <p><a href="{ticket_url}">View Ticket</a></p>
        ';
    }

    private function getTicketClosedTemplate(): string
    {
        return '
        <h2>Ticket Closed</h2>
        <p>Hello {customer_name},</p>
        <p>Your support ticket has been closed:</p>
        <ul>
            <li><strong>Ticket ID:</strong> {ticket_id}</li>
            <li><strong>Subject:</strong> {ticket_subject}</li>
            <li><strong>Closed by:</strong> {agent_name}</li>
            <li><strong>Date:</strong> {closed_date}</li>
        </ul>
        <p>Please rate your experience: <a href="{rating_url}">Rate Now</a></p>
        ';
    }

    private function getTicketAssignedTemplate(): string
    {
        return '
        <h2>Ticket Assigned</h2>
        <p>Hello {agent_name},</p>
        <p>A ticket has been assigned to you:</p>
        <ul>
            <li><strong>Ticket ID:</strong> {ticket_id}</li>
            <li><strong>Subject:</strong> {ticket_subject}</li>
            <li><strong>Customer:</strong> {customer_name}</li>
            <li><strong>Priority:</strong> {priority}</li>
            <li><strong>Assigned:</strong> {assigned_date}</li>
        </ul>
        <p><a href="{ticket_url}">View Ticket</a></p>
        ';
    }
} 