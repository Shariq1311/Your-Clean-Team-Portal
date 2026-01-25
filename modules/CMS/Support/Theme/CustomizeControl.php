<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Support\Theme;

use MojarCMS\CMS\Abstracts\CustomizeControl as BaseCustomizeControl;

class CustomizeControl extends BaseCustomizeControl
{
    public function contentTemplate()
    {
        switch ($this->args->get('type')) {
            case 'text':
                return view('cms::backend.editor.control.text', [
                    'args' => $this->args,
                    'key' => $this->key,
                ]);
            case 'textarea':
                return view('cms::backend.editor.control.textarea', [
                    'args' => $this->args,
                    'key' => $this->key,
                ]);
            case 'site_identity':
                return view('cms::backend.editor.control.site_identity', [
                    'args' => $this->args,
                    'key' => $this->key,
                ]);
        }

        return '';
    }
}
