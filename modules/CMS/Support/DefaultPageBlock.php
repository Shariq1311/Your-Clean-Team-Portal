<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Support;

use MojarCMS\CMS\Abstracts\PageBlock;

class DefaultPageBlock extends PageBlock
{
    /**
     * Creating widget front-end
     *
     * @param array $data
     * @return \Illuminate\View\View
     */
    public function show($data)
    {
        return $this->view(
            $this->data['view'],
            compact(
                'data'
            )
        );
    }
}
