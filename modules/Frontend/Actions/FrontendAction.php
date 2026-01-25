<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Frontend\Actions;

use Illuminate\Support\Facades\File;
use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;
use MojarCMS\CMS\Facades\ThemeLoader;

class FrontendAction extends Action
{
    public function handle(): void
    {
        $this->addAction(self::FRONTEND_HEADER_ACTION, [$this, 'addFrontendHeader']);
        $this->addAction(self::FRONTEND_FOOTER_ACTION, [$this, 'addFrontendFooter']);
        //$this->addAction('theme.after_body', [$this, 'addThemeBody']);
    }

    public function addFrontendHeader(): void
    {
        $fbAppId = get_config('fb_app_id');
        $googleAnalytics = get_config('google_analytics');
        $scripts = HookAction::getEnqueueFrontendScripts();
        $styles = HookAction::getEnqueueFrontendStyles();
        $bingKey = get_config('bing_verify_key');
        $googleKey = get_config('google_verify_key');

        echo e(
            view(
                'cms::items.frontend_header',
                compact(
                    'fbAppId',
                    'googleAnalytics',
                    'scripts',
                    'styles',
                    'bingKey',
                    'googleKey'
                )
            )
        );
    }

    public function addFrontendFooter(): void
    {
        $scripts = HookAction::getEnqueueFrontendScripts(true);
        $styles = HookAction::getEnqueueFrontendStyles(true);

        echo e(view('cms::items.frontend_footer', compact('scripts', 'styles')));
    }

    public function addThemeBody(): void
    {
        $str = '';
        $theme = mc_current_theme();
        $styles = ThemeLoader::getRegister($theme)['styles'] ?? [];

        foreach ($styles['css'] ?? [] as $css) {
            if (is_url($css)) {
                continue;
            }

            $str .= File::get(public_path("mc-styles/themes/{$theme}/{$css}"));
        }

        if ($str) {
            echo '<style>' . $str . '</style>';
        }
    }
}
