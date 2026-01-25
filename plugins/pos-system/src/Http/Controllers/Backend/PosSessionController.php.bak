<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use MojarCMS\CMS\Http\Controllers\BackendController;
use MojarCMS\CMS\Traits\ResourceController;
use Mojahid\PosSystem\Http\Datatables\PosSessionDatatable;
use Mojahid\PosSystem\Models\PosSession;

final class PosSessionController extends BackendController
{
    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected string $viewPrefix = 'pos::backend.session';

    protected function getDataTable(...$params)
    {
        return new PosSessionDatatable();
    }

    protected function validator(array $attributes, ...$params): \Illuminate\Validation\Validator
    {
        return Validator::make(
            $attributes,
            [
                'session_name' => 'nullable|string|max:255',
                'opening_balance' => 'required|numeric|min:0',
                'closing_balance' => 'nullable|numeric|min:0',
                'status' => 'required|string|in:active,closed',
                'notes' => 'nullable|string',
            ]
        );
    }

    protected function getModel(...$params): string
    {
        return PosSession::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('pos::content.sessions');
    }

    public function getFieldName(): string
    {
        return 'id';
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model, ...$params);
        
        $data['statuses'] = [
            'active' => trans('Active'),
            'closed' => trans('Closed'),
        ];
        
        return $data;
    }

    protected function parseDataForSave(array $attributes, ...$params): array
    {
        // Remove any content field that might be sent by the framework
        unset($attributes['content']);
        
        return $attributes;
    }

    protected function beforeSave(&$data, &$model, ...$params): void
    {
        $data['user_id'] = auth()->id();
        
        if (!$model->exists) {
            $data['opened_at'] = now();
        }
    }

    public function show($id)
    {
        $session = PosSession::with(['user', 'orders', 'carts'])->findOrFail($id);

        $data = [
            'session' => $session,
            'title' => $session->session_name ?: 'Session #' . $session->id,
            'statuses' => [
                'active' => trans('Active'),
                'closed' => trans('Closed'),
            ],
        ];

        return $this->view('pos::backend.session.show', $data);
    }

    // public function edit($id)
    // {
    //     $model = PosSession::findOrFail($id);
    //     $data = $this->getDataForForm($model);
        
    //     return view("{$this->viewPrefix}.form", compact('model') + $data);
    // }
    

    public function startSession(Request $request): JsonResponse
    {
        $request->validate([
            'session_name' => 'nullable|string|max:255',
            'opening_balance' => 'required|numeric|min:0',
        ]);

        // Check if user already has an active session
        $existingSession = PosSession::where('user_id', auth()->id())
            ->where('status', 'active')
            ->first();

        if ($existingSession) {
            return response()->json([
                'success' => false,
                'message' => trans('You already have an active session'),
            ], 400);
        }

        $session = PosSession::create([
            'user_id' => auth()->id(),
            'session_name' => $request->session_name ?: 'Session ' . now()->format('Y-m-d H:i'),
            'opening_balance' => $request->opening_balance,
            'status' => 'active',
            'opened_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => trans('Session started successfully'),
            'session' => $session->toArray(),
        ]);
    }

    public function endSession(Request $request): JsonResponse
    {
        $request->validate([
            'closing_balance' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $session = PosSession::where('user_id', auth()->id())
            ->where('status', 'active')
            ->first();

        if (!$session) {
            return response()->json([
                'success' => false,
                'message' => trans('No active session found'),
            ], 404);
        }

        $session->update([
            'closing_balance' => $request->closing_balance,
            'expected_balance' => $session->getExpectedCashBalance(),
            'status' => 'closed',
            'closed_at' => now(),
            'notes' => $request->notes,
        ]);

        return response()->json([
            'success' => true,
            'message' => trans('Session ended successfully'),
            'session' => $session->fresh()->toArray(),
            'cash_difference' => $session->getCashDifference(),
        ]);
    }

    public function getSessionInfo(Request $request): JsonResponse
    {
        $session = PosSession::where('user_id', auth()->id())
            ->where('status', 'active')
            ->with(['orders' => function ($query) {
                $query->where('status', 'completed');
            }])
            ->first();

        if (!$session) {
            return response()->json([
                'success' => false,
                'message' => trans('No active session found'),
            ], 404);
        }

        return response()->json([
            'success' => true,
            'session' => $session->toArray(),
            'stats' => [
                'total_sales' => $session->getTotalSales(),
                'total_transactions' => $session->total_transactions,
                'expected_balance' => $session->getExpectedCashBalance(),
                'cash_difference' => $session->getCashDifference(),
            ],
        ]);
    }

    public function closeSession(Request $request, $id): JsonResponse|RedirectResponse
    {
        $session = PosSession::findOrFail($id);

        if ($session->status === 'closed') {
            $message = trans('Session is already closed');
            
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $message], 400);
            }
            
            return redirect()->back()->with('error', $message);
        }

        $request->validate([
            'closing_balance' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $session->update([
            'closing_balance' => $request->closing_balance,
            'expected_balance' => $session->getExpectedCashBalance(),
            'status' => 'closed',
            'closed_at' => now(),
            'notes' => $request->notes,
        ]);

        $message = trans('Session closed successfully');

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return redirect()->back()->with('success', $message);
    }
} 