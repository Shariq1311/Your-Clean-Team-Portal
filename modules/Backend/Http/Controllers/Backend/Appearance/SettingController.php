<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Backend\Http\Controllers\Backend\Appearance;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MojarCMS\CMS\Contracts\HookActionContract;
use MojarCMS\CMS\Contracts\LocalThemeRepositoryContract;
use MojarCMS\CMS\Http\Controllers\BackendController;

class SettingController extends BackendController
{
    public function __construct(
        protected LocalThemeRepositoryContract $themeRepository,
        protected HookActionContract $hookAction
    ) {
        //
    }

    public function index(): View
    {
        $fnParseToField = function ($item) {
            $item['type'] = $item['data']['type'] ?? 'text';
            return $item;
        };

        $title = trans('cms::app.setting');
        $configs = $this->hookAction->getThemeSettings()
            ->map($fnParseToField)
            ->values()
            ->toArray();

        return view(
            'cms::backend.appearance.setting.index',
            compact('title', 'configs')
        );
    }

    public function save(Request $request): JsonResponse|RedirectResponse
    {
        $configs = $request->post('config', []);
        $themeConfigs = $request->post('theme', []);

        foreach ($configs as $name => $value) {
            set_config($name, $value);
        }

        foreach ($themeConfigs as $name => $value) {
            set_theme_config($name, $value);
        }

        return $this->success(
            trans('cms::app.updated_successfully')
        );
    }
}
