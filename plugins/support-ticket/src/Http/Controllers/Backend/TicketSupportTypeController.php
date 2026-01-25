<?php

namespace Mojahid\SupportTicket\Http\Controllers\Backend;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Validator;
use MojarCMS\Backend\Http\Controllers\Backend\PageController;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Traits\ResourceController;
use Mojahid\SupportTicket\Http\Datatables\TicketSupportTypeDatatable;
use Mojahid\SupportTicket\Models\TicketSupportType;

class TicketSupportTypeController extends PageController
{
    use ResourceController;

    protected string $viewPrefix = 'sticket::backend.ticket_support_type';

    public function getBreadcrumbPrefix(...$params) : void
    {
        $this->addBreadcrumb(
            [
                'title' => __('Ticket Support'),
                'url' => action([TicketSupportController::class, 'index'])
            ]
        );
    }

    protected function getDataTable(...$params): DataTable
    {
        return new TicketSupportTypeDatatable();
    }

    protected function validator(array $attributes, ...$params): ValidatorContract
    {
        return Validator::make(
            $attributes,
            [
                'name' => ['required', 'string', 'max:100'],
            ]
        );
    }

    
    protected function getTitle(...$params): string
    {
        return trans('Types');
    }

    public function getFieldName(): string
    {
        return 'id';
    }

    public function edit($id)
    {
        $model = TicketSupportType::findOrFail($id);
        $data = $this->getDataForForm($model);
        $data['title'] = trans('Types');
        
        return view("{$this->viewPrefix}.form", compact('model') + $data);
    }

    protected function getModel(...$params): string
    {
        return TicketSupportType::class;
    }

}
