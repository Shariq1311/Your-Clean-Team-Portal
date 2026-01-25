<?php

namespace Mojahid\SupportTicket\Providers;

use MojarCMS\CMS\Support\ServiceProvider;
use Mojahid\SupportTicket\Actions\AjaxAction;
use Mojahid\SupportTicket\Actions\FrontendAction;
use Mojahid\SupportTicket\Actions\MenuAction;
use Mojahid\SupportTicket\Actions\SettingAction;
use Mojahid\SupportTicket\Repositories\TicketSupportAttachmentRepository;
use Mojahid\SupportTicket\Repositories\TicketSupportAttachmentRepositoryEloquent;
use Mojahid\SupportTicket\Repositories\TicketSupportCommentRepository;
use Mojahid\SupportTicket\Repositories\TicketSupportCommentRepositoryEloquent;
use Mojahid\SupportTicket\Repositories\TicketSupportRepository;
use Mojahid\SupportTicket\Repositories\TicketSupportRepositoryEloquent;
use Mojahid\SupportTicket\Repositories\TicketSupportTypeRepository;
use Mojahid\SupportTicket\Repositories\TicketSupportTypeRepositoryEloquent;
use Mojahid\SupportTicket\Models\TicketSupport;
use Mojahid\SupportTicket\Models\TicketSupportType;
use Mojahid\SupportTicket\Policies\TicketSupportPolicy;
use Mojahid\SupportTicket\Policies\TicketSupportTypePolicy;

class SupportTicketServiceProvider extends ServiceProvider
{
    public array $bindings = [
        TicketSupportTypeRepository::class => TicketSupportTypeRepositoryEloquent::class,
        TicketSupportRepository::class => TicketSupportRepositoryEloquent::class,
        TicketSupportCommentRepository::class => TicketSupportCommentRepositoryEloquent::class,
        TicketSupportAttachmentRepository::class => TicketSupportAttachmentRepositoryEloquent::class,
    ];

    public array $policies = [
        TicketSupport::class => TicketSupportPolicy::class,
        TicketSupportType::class => TicketSupportTypePolicy::class,
    ];

    public function boot()
    {
        $this->registerHookActions([MenuAction::class, AjaxAction::class, FrontendAction::class, SettingAction::class]);
    }

    public function register()
    {
        //
    }
}
