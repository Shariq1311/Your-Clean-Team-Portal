<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    GNU General Public License v2.0
 */

namespace MojarCMS\API\Support\Documentation;

use MojarCMS\API\Support\Swagger\SwaggerDocument;

interface APISwaggerDocumentation
{
    public function handle(SwaggerDocument $document): SwaggerDocument;
}
