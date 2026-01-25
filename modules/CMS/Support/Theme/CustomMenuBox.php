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

use MojarCMS\CMS\Abstracts\MenuBox;

class CustomMenuBox extends MenuBox
{
    public function mapData($data)
    {
        $result[] = $this->getData($data);

        return $result;
    }

    public function getData($item)
    {
        return [
            'label' => $item['label'],
            'link' => $item['link'],
        ];
    }

    public function addView()
    {
        return view('cms::backend.menu.boxs.custom_add');
    }

    public function editView($item)
    {
        return view('cms::backend.menu.boxs.custom_edit', [
            'item' => $item,
        ]);
    }

    public function getLinks($menuItems)
    {
        return $menuItems;
    }
}
