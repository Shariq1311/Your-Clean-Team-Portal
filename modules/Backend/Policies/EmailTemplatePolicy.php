<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Backend\Policies;

use MojarCMS\CMS\Abstracts\ResourcePolicy;

class EmailTemplatePolicy extends ResourcePolicy
{
    protected string $resourceType = 'email_templates';
}
