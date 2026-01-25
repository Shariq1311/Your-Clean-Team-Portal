<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Models\User;
use Mojahid\PosSystem\Models\PosSession;

final class PosSessionDatatable extends DataTable
{
    public function columns(): array
    {
        return [
            'id' => [
                'label' => "ID",
                'width' => '5%',
            ],
            'session_name' => [
                'label' => trans('Session Name'),
                'formatter' => function ($value, $row, $index) {
                    return view('cms::backend.items.datatable_item', [
                        'value' => $value ?: 'Session #' . $row->id,
                        'row' => $row,
                        'actions' => $this->rowAction($row),
                        'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                    ])
                    ->render();
                },
                'width' => '20%',
            ],
            'user_id' => [
                'label' => trans('User'),
                'formatter' => function ($value, $row) {
                    $user = User::find($value);
                    return $user->name ?? 'N/A';
                },
                'width' => '15%',
            ],
            'opening_balance' => [
                'label' => trans('Opening Balance'),
                'formatter' => function ($value) {
                    return pos_format_price($value);
                },
                'width' => '12%',
            ],
            'closing_balance' => [
                'label' => trans('Closing Balance'),
                'formatter' => function ($value) {
                    return $value !== null ? pos_format_price($value) : trans('N/A');
                },
                'width' => '12%',
            ],
            'total_transactions' => [
                'label' => trans('Transactions'),
                'width' => '8%',
            ],
            'status' => [
                'label' => trans('cms::app.status'),
                'formatter' => [$this, 'statusFormatter'],
                'width' => '10%',
            ],
            'opened_at' => [
                'label' => trans('Opened At'),
                'formatter' => function ($value) {
                    return mc_date_format($value);
                },
                'width' => '15%',
            ],
        ];
    }

    public function statusFormatter($value, $row): string
    {
        return match ($value) {
            'active' => '<span class="badge badge-success">Active</span>',
            'closed' => '<span class="badge badge-secondary">Closed</span>',
            default => '<span class="badge badge-light">' . ucfirst($value) . '</span>',
        };
    }

    public function query(array $data): \Illuminate\Contracts\Database\Query\Builder
    {
        $query = PosSession::select([
            'id',
            'session_name',
            'user_id',
            'opening_balance',
            'closing_balance',
            'total_transactions',
            'status',
            'opened_at',
            'created_at',
        ]);

        if ($status = Arr::get($data, 'status')) {
            $query->where('status', $status);
        }

        if ($userId = Arr::get($data, 'user_id')) {
            $query->where('user_id', $userId);
        }

        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(
                function (\Illuminate\Database\Query\Builder $q) use ($keyword) {
                    $q->where('session_name', MC_SQL_LIKE, '%'. $keyword .'%');
                }
            );
        }

        return $query;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                PosSession::whereIn('id', $ids)->delete();
                break;
        }
    }

    public function rowAction($row): array
    {
        $actions = parent::rowAction($row);

        $actions['show'] = [
            'label' => trans('cms::app.view'),
            'url' => route('admin.pos-system.sessions.show', [$row->id]),
            'class' => 'text-info',
        ];

        return $actions;
    }
} 