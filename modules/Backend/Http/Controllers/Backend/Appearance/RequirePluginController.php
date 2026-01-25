<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Backend\Http\Controllers\Backend\Appearance;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use MojarCMS\CMS\Facades\ThemeLoader;
use MojarCMS\CMS\Http\Controllers\BackendController;

class RequirePluginController extends BackendController
{
    public function index(): View
    {
        $this->addBreadcrumb(
            [
                'title' => trans('cms::app.themes'),
                'url' => route('admin.themes'),
            ]
        );

        $title = trans('cms::app.require_plugins');

        return view(
            'cms::backend.theme.require',
            compact(
                'title'
            )
        );
    }

    public function getData(): JsonResponse
    {
        $themeInfo = ThemeLoader::getThemeInfo(mc_current_theme());
        $require = $themeInfo->get('require', []);
        $result = [];

        foreach ($require as $plugin => $ver) {
            $info = app('plugins')->find($plugin);
            if ($info) {
                if ($info->isEnabled()) {
                    continue;
                }
            }

            $result[] = [
                'id' => $plugin,
                'key' => $plugin,
                'version' => $ver,
                'status' => $info ? 'installed' : 'not_installed',
            ];
        }

        return response()->json(
            [
                'total' => count($result),
                'rows' => $result,
            ]
        );
    }
}
