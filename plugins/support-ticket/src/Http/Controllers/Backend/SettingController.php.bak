<?php

namespace Mojahid\SupportTicket\Http\Controllers\Backend;

use MojarCMS\CMS\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SettingController extends BackendController
{
    public function index()
    {
        $title = trans('sticket::content.support_ticket_settings');
        
        return $this->view('sticket::backend.setting.index', compact('title'));
    }

    public function save(Request $request): JsonResponse
    {
        $data = $request->all();
        
        // Remove CSRF token and method
        unset($data['_token'], $data['_method']);
        
        foreach ($data as $key => $value) {
            set_config($key, $value);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => trans('cms::app.saved_successfully'),
            'redirect' => route('admin.support-ticket.setting')
        ]);
    }
} 