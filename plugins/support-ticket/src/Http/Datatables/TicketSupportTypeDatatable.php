<?php

namespace Mojahid\SupportTicket\Http\Datatables;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Arr;
use MojarCMS\CMS\Abstracts\DataTable;
use Mojahid\SupportTicket\Models\TicketSupportType;

class TicketSupportTypeDatatable extends DataTable
{
    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'name' => [
                'label' => trans('sticket::content.name'),
                'formatter' => [$this, 'rowActionsFormatter'],
            ],
            'created_at' => [
                'label' => trans('cms::app.created_at'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return mc_date_format($row->created_at);
                }
            ]
        ];
    }

    /**
     * Query data datatable
     *
     * @param  array  $data
     * @return Builder
     */
    public function query(array $data): Builder
    {
        $query = TicketSupportType::query();

        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(function (Builder $q) use ($keyword) {
                // $q->where('title', MC_SQL_LIKE, '%'. $keyword .'%');
            });
        }

        return $query;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                TicketSupportType::destroy($ids);
                break;
        }
    }
}
