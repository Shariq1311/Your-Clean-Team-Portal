<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/laravel-cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com/cms
 * @license    MIT
 */

namespace MojarCMS\Network\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\Network\Contracts\SiteManagerContract;
use MojarCMS\Network\Models\Site;

class SiteDatatable extends DataTable
{
    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'domain' => [
                'label' => trans('cms::app.domain'),
                'formatter' => [$this, 'rowActionsFormatter'],
            ],
            'status' => [
                'label' => trans('cms::app.status'),
                'width' => '15%',
                'align' => 'center',
            ],
            'created_at' => [
                'label' => trans('cms::app.created_at'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return mc_date_format($row->created_at);
                },
            ],
        ];
    }

    public function rowAction($row): array
    {
        $rows = parent::rowAction($row);
        $networkDomain = config('network.domain');
        $loginUrl = app(SiteManagerContract::class)->getLoginUrl($row);

        $rows['login'] = [
            'label' => 'Login',
            'url' => $loginUrl,
            'target' => '_blank',
        ];

        $rows['view'] = [
            'label' => trans('cms::app.view_site'),
            'url' => "http://{$row->domain}.{$networkDomain}",
            'target' => '_blank',
        ];

        return $rows;
    }

    public function query($data): Builder
    {
        $query = Site::query();
        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(
                function (Builder $q) use ($keyword) {
                    $q->where('domain', 'like', $keyword);
                }
            );
        }

        return $query;
    }

    public function actions(): array
    {
        return [
            'delete' => trans('cms::app.delete'),
            'banned' => trans('cms::app.banned'),
            'active' => trans('cms::app.active'),
        ];
    }

    public function bulkActions($action, $ids)
    {
        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    Site::destroy([$id]);
                }

                break;
            case Site::STATUS_BANNED:
            case Site::STATUS_ACTIVE:
                Site::whereIn('id', $ids)
                    ->update(
                        [
                            'status' => $action
                        ]
                    );
                break;
        }
    }
}
