<?php
/**
 * Mojar CMS - The Best CMS for Laravel Project
 *
 * @package    mojahid/newsletters
 * @author     Mojahid <mojahid.dev@gmail.com>
 * @link       https://mojahid.dev
 * @license    MIT
 */

namespace Mojahid\Newsletters\Http\Controllers\Backend;

use MojarCMS\CMS\Traits\ResourceController;
use Illuminate\Support\Facades\Validator;
use MojarCMS\Backend\Http\Controllers\Backend\PageController;
use MojarCMS\CMS\Abstracts\DataTable;
use Mojahid\Newsletters\Http\Datatables\NewslettersDatatable;
use Mojahid\Newsletters\Models\NewslettersSubscriber;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;

class NewslettersController extends PageController
{
    use ResourceController;

    protected string $viewPrefix = 'newsletters::backend.newsletters-subscribers';

    protected function getDataTable(...$params): DataTable
    {
        return new NewslettersDatatable();
    }

    protected function validator(array $attributes, ...$params): ValidatorContract
    {
        return Validator::make(
            $attributes,
            [
                // Rules
            ]
        );
    }

    protected function getModel(...$params): string
    {
        return NewslettersSubscriber::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('newsletters::content.newsletters_subscribers');
    }
}
