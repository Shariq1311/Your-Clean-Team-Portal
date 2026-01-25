<?php

namespace Mojahid\SupportTicket\Http\Controllers\Backend;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Http\Controllers\BackendController;
use MojarCMS\CMS\Traits\ResourceController;
use Mojahid\SupportTicket\Http\Datatables\TicketSupportDatatable;
use Mojahid\SupportTicket\Http\Requests\Backend\ReplyRequest;
use Mojahid\SupportTicket\Models\TicketSupport;
use Mojahid\SupportTicket\Repositories\TicketSupportCommentRepository;
use Mojahid\SupportTicket\Repositories\TicketSupportRepository;
use Mojahid\SupportTicket\Repositories\TicketSupportTypeRepository;
use Illuminate\Http\Request;

class TicketSupportController extends BackendController
{
    protected string $viewPrefix = 'sticket::backend.ticket_support';

    use ResourceController {
        getDataForForm as DataForForm;
    }

    public function __construct(
        protected TicketSupportRepository $ticketSupportRepository,
        protected TicketSupportTypeRepository $supportTypeRepository,
        protected TicketSupportCommentRepository $supportCommentRepository
    ) {
    }

    public function comment(ReplyRequest $request, $id): JsonResponse|RedirectResponse
    {
        $ticket = $this->ticketSupportRepository->find($id);

        $data = $request->only(['content']);
        $data['ticket_support_id'] = $id;

        $comment = DB::transaction(
            function () use ($data, $ticket) {
                $ticket->updateQuietly(['status' => TicketSupport::STATUS_REPLIED]);

                return $this->supportCommentRepository->create($data);
            }
        );

        $comment->load(['createdBy']);
        $comment->created_date = mc_date_format($comment->created_at);

        return $this->success(
            [
                'status' => true,
                'message' => 'Reply ticket successfull.',
                'comment' => $comment,
            ]
        );
    }

    public function deleteComment(Request $request): JsonResponse
    {
        $commentId = $request->input('comment_id');
        
        if (!$commentId) {
            return $this->error('Comment ID is required.');
        }

        $comment = $this->supportCommentRepository->find($commentId);
        
        if (!$comment) {
            return $this->error('Comment not found.');
        }

        $this->supportCommentRepository->delete($commentId);

        return $this->success([
            'status' => 'success',
            'message' => 'Comment deleted successfully.'
        ]);
    }

    public function closeTicket(Request $request, $id): JsonResponse
    {
        $ticket = $this->ticketSupportRepository->find($id);
        
        if (!$ticket) {
            return $this->error('Ticket not found.');
        }

        $ticket->update(['status' => 'closed']);

        return $this->success([
            'status' => 'success',
            'message' => 'Ticket closed successfully.'
        ]);
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model, ...$params);

        $data['supportTypes'] = $this->supportTypeRepository->all()
            ->mapWithKeys(fn ($item) => [$item->id => $item->name]);
        $data['comments'] = $this->supportCommentRepository
            ->with(['createdBy'])
            ->scopeQuery(fn($q) => $q->where(['ticket_support_id' => $model->id]))
            ->paginate(10);

        return $data;
    }

    protected function getDataTable(...$params): DataTable
    {
        return TicketSupportDatatable::make();
    }

    protected function validator(array $attributes, ...$params): ValidatorContract
    {
        return Validator::make(
            $attributes,
            [
                'title' => ['required'],
                'content' => ['required'],
            ]
        );
    }

    protected function getModel(...$params): string
    {
        return TicketSupport::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('Ticket supports');
    }
}
