<?php

namespace Mojahid\SupportTicket\Actions;

use MojarCMS\CMS\Abstracts\Action;
use Mojahid\SupportTicket\Http\Resources\TicketSupportCollection;
use Mojahid\SupportTicket\Http\Resources\TicketSupportCommentCollection;
use Mojahid\SupportTicket\Http\Resources\TicketSupportResource;
use Mojahid\SupportTicket\Http\Resources\TicketSupportTypeCollection;
use Mojahid\SupportTicket\Models\TicketSupport;
use Mojahid\SupportTicket\Models\TicketSupportComment;
use Mojahid\SupportTicket\Models\TicketSupportType;
use MojarCMS\CMS\Facades\HookAction;

class FrontendAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::FRONTEND_INIT, [$this, 'registerProfilePages']);
    }

    public function registerProfilePages(): void
    {
        $user = request()->user();

        HookAction::registerProfilePage(
            'support-tickets-page',
            [
                'title' => __('Support Tickets'),
                'key' => 'support-tickets', 
                'icon' => 'fa fa-ticket',
                'contents' => 'sticket::frontend.profile.ticket_support.index',
                'position' => 1,
                'data' => [
                    'ticketSupports' => function () use ($user) {
                        $posts = TicketSupport::with(['type', 'user'])
                            ->where(['created_by' => $user->id])
                            ->paginate(10);

                        return TicketSupportCollection::make($posts)
                            ->response()
                            ->getData(true);
                    },
                    'ticketSupport' => function () {
                        if ($id = request()->input('id')) {
                            $ticketSupport = TicketSupport::with(
                                [
                                    'attachments' => fn($q) => $q->whereNull('comment_id'),
                                    'type',
                                    'user',
                                ]
                            )->find($id);

                            return TicketSupportResource::make($ticketSupport)
                                ->response()
                                ->getData(true)['data'];
                        }
                        return collect();
                    },
                    'ticketSupportComments' => function () {
                        if ($id = request()->input('id')) {
                            $commemts = TicketSupportComment::with('attachments')->where('ticket_support_id',
                                $id)->get();

                            return TicketSupportCommentCollection::make($commemts)
                                ->response()
                                ->getData(true)['data'];
                        }
                        return collect();
                    },
                ],
            ]
        );

        HookAction::registerProfilePage(
            'support-tickets-create',
            [
               'title' => __('Create Ticket Support'),
               'key' => 'support-tickets-create',
               'contents' => 'sticket::frontend.profile.ticket_support.create',
               'position' => 3,
               'data' => [
                    'types' => TicketSupportType::get()
                ],
            ]
        );

        // HookAction::registerProfilePage(
        //     'support-tickets-2',
        //     [
        //         'title' => __('Support Tickets 2'),
        //         'key' => 'support-tickets-2', 
        //         'icon' => 'fa fa-ticket',
        //         'contents' => 'sticket::frontend.profile.ticket_support.index',
        //         'position' => 1,
        //         'data' => [
        //             'ticketSupports' => function () use ($user) {
        //                 $posts = TicketSupport::with(['type', 'user'])
        //                     ->where(['created_by' => $user->id])
        //                     ->paginate(10);

        //                 return TicketSupportCollection::make($posts)
        //                     ->response()
        //                     ->getData(true);
        //             },
        //             'ticketSupport' => function () {
        //                 if ($id = request()->input('id')) {
        //                     $ticketSupport = TicketSupport::with(
        //                         [
        //                             'attachments' => fn($q) => $q->whereNull('comment_id'),
        //                             'type',
        //                             'user',
        //                         ]
        //                     )->find($id);

        //                     return TicketSupportResource::make($ticketSupport)
        //                         ->response()
        //                         ->getData(true)['data'];
        //                 }
        //                 return collect();
        //             },
        //             'ticketSupportComments' => function () {
        //                 if ($id = request()->input('id')) {
        //                     $commemts = TicketSupportComment::with('attachments')->where('ticket_support_id',
        //                         $id)->get();

        //                     return TicketSupportCommentCollection::make($commemts)
        //                         ->response()
        //                         ->getData(true)['data'];
        //                 }
        //                 return collect();
        //             },
        //         ],
        //     ]
        // );

    }
}
