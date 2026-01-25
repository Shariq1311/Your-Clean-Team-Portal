<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com
 * @license    GNU V2
 */

namespace MojarCMS\Backend\Models\Email;

use MojarCMS\CMS\Models\Model;

/**
 * MojarCMS\Backend\Models\Email\EmailTemplateUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplateUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplateUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplateUser query()
 * @mixin \Eloquent
 */
class EmailTemplateUser extends Model
{
    protected $table = 'email_template_users';
    protected $fillable = ['user_id', 'email_template_id'];
}
