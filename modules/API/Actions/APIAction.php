<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    GNU General Public License v2.0
 */

namespace MojarCMS\API\Actions;

use MojarCMS\API\Support\Documentation\AuthSwaggerDocumentation;
use MojarCMS\API\Support\Documentation\PostTypeAdminSwaggerDocumentation;
use MojarCMS\API\Support\Documentation\PostTypeSwaggerDocumentation;
use MojarCMS\API\Support\Swagger\SwaggerDocument;
use MojarCMS\CMS\Abstracts\Action;

class APIAction extends Action
{
    public function handle()
    {
        $this->addAction(Action::BACKEND_INIT, [$this, 'addAdminMenu']);
        if (config('Mojar.api.frontend.enable')) {
            $this->addAction(Action::API_DOCUMENT_INIT, [$this, 'addAPIDocumentation'], 1);
        }
    }

    public function addAPIDocumentation()
    {
        $document = SwaggerDocument::make('frontend');
        $document->setTitle('Frontend');
        $document->append(AuthSwaggerDocumentation::class);
        $document->append(PostTypeSwaggerDocumentation::class);
        $this->hookAction->registerAPIDocument($document);
    }

    public function addAdminDocumentation()
    {
        $apiAdmin = SwaggerDocument::make('admin');
        $apiAdmin->setTitle('Admin');
        $apiAdmin->setPrefix('admin');
        $apiAdmin->append(PostTypeAdminSwaggerDocumentation::class);
        $this->hookAction->registerAPIDocument($apiAdmin);
    }

    public function addAdminMenu()
    {
        // $this->hookAction->registerAdminPage(
        //     'api.documentation',
        //     [
        //         'title' => trans('cms::app.api_documentation'),
        //         'menu' => [
        //             'icon' => 'fa fa-book',
        //             'position' => 95,
        //         ],
        //     ]
        // );
    }
}
