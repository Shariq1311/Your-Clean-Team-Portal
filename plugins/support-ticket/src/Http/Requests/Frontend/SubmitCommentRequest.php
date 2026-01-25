<?php
/**
 * Mojar CMS - Laravel CMS for Your Project
 *
 * @package    Mojarcms/Mojarcms
 * @author     Mojar Team
 * @link       https://Mojarcms.com
 * @license    GNU V2
 */

namespace Mojahid\SupportTicket\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class SubmitCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => ['required']
        ];
    }
}
