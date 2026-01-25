<?php

namespace MojarCMS\Backend\Http\Controllers\Backend;

use MojarCMS\CMS\Http\Controllers\BackendController;

class PermissionController extends BackendController
{
    public function index()
    {
        //

        return view('jupe::index', [
            'title' => 'Title Page',
        ]);
    }
}
