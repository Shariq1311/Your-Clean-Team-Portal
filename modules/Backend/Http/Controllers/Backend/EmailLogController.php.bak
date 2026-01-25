<?php

namespace MojarCMS\Backend\Http\Controllers\Backend;

use Illuminate\Contracts\View\View;
use MojarCMS\CMS\Http\Controllers\BackendController;
use MojarCMS\Backend\Http\Datatables\EmailLogDatatable;

class EmailLogController extends BackendController
{
    public function index(): View
    {
        $dataTable = new EmailLogDatatable();
        $title = trans('cms::app.email_logs');

        return view(
            'cms::backend.logs.email',
            compact(
                'title',
                'dataTable'
            )
        );
    }
}
