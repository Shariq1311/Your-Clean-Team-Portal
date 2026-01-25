<?php

namespace Mojahid\SupportTicket\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use MojarCMS\CMS\Abstracts\DataTable;
use Mojahid\SupportTicket\Models\TicketSupport;
use Mojahid\SupportTicket\Repositories\TicketSupportRepository;
use Illuminate\Support\Facades\Auth;

class TicketSupportDatatable extends DataTable
{
    public function __construct(protected TicketSupportRepository $ticketSupportRepository)
    {
    }

    protected string $sortName = 'created_at';

    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'title' => [
                'label' => __('Title'),
                'formatter' => [$this, 'rowActionsFormatter'],
            ],
            'customer' => [
                'label' => __('Customer'),
                'width' => '10%',
                'align' => 'center',
                'sortable' => false,
            ],
            'status' => [
                'label' => __('Status'),
                'formatter' => fn($value, $row, $index) => $row->status_label,
                'width' => '10%',
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
        $query = $this->ticketSupportRepository
            ->withSearchs(Arr::get($data, 'keyword'))
            ->withFilters($data)
            ->getQuery();

        if (Auth::check() && Auth::user()->hasRole('vendor')) {
            $query->where('created_by', Auth::id());
        }

        return $query;
    }

    public function actions(): array
    {
        return [
            'close' => trans('cms::app.close'),
            'delete' => trans('cms::app.delete'),
        ];
    }

    public function searchFields(): array
    {
        $fields = parent::searchFields();
        $fields['status'] = [
            'type' => 'select',
            'label' => __('Status'),
            'options' => TicketSupport::getStatuses(),
        ];

        return $fields;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                TicketSupport::destroy($ids);
                break;
            case 'close':
                TicketSupport::whereIn('id', $ids)
                    ->get()
                    ->each(fn($item) => $item->update(['status' => TicketSupport::STATUS_CLOSE]));
        }
    }
}
