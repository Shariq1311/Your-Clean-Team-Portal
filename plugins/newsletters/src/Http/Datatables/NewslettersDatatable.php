<?php
/**
 * Mojar CMS - The Best CMS for Laravel Project
 *
 * @package    Mojarcms/Mojarcms
 * @author     MojarCMS Team <admin@Mojarcms.com>
 * @link       https://Mojarcms.com
 * @license    MIT
 */

namespace Mojahid\Newsletters\Http\Datatables;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\CMS\Repositories\Criterias\FilterCriteria;
use MojarCMS\CMS\Repositories\Criterias\SearchCriteria;
use MojarCMS\CMS\Repositories\Criterias\SortCriteria;
use Mojahid\Newsletters\Repositories\NewslettersRepository;

class NewslettersDatatable extends DataTable
{
    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'email' => [
                'label' => trans('newsletters::content.email'),
                'formatter' => function ($value, $row, $index) {
                    return view(
                        'cms::backend.items.datatable_item',
                        [
                            'value' => $row->email,
                            'row' => $row,
                            'actions' => $this->rowAction($row),
                            'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                            'title_hidden' => false,
                            'actions_hidden' => true,
                        ]
                    )
                    ->render();
                }
            ],
            'is_subscribed' => [
                'label' => trans('newsletters::content.is_subscribed'),
                'width' => '10%',
                'align' => 'center',
            ],
            'created_at' => [
                'label' => trans('cms::app.created_at'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return mc_date_format($row->created_at);
                }
            ],
            'operations' => [
                'label' => trans('cms::app.operations'),
                'width' => '10%',
                'align' => 'center',
                'sortable' => false,
                'formatter' => function ($value, $row, $index) {
                    return view(
                        'cms::backend.items.datatable_item',
                        [
                            'value' => $row->email,
                            'row' => $row,
                            'actions' => $this->rowAction($row),
                            'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                            'title_hidden' => true,
                            'actions_hidden' => false,
                        ]
                    )
                    ->render();
                },
            ],
        ];
    }

    /**
     * Query data datatable
     *
     * @param  array  $data
     * @return Builder
     * @throws BindingResolutionException
     */
    public function query(array $data): Builder
    {
        return app()->make(NewslettersRepository::class)
            ->pushCriteria(new SearchCriteria($data))
            ->pushCriteria(new FilterCriteria($data))
            ->pushCriteria(new SortCriteria($data))
            ->getQuery();
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    app(NewslettersRepository::class)->delete($id);
                }
                break;
        }
    }
}
