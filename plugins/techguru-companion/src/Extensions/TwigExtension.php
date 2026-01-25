<?php

namespace Mojahid\MojarCompanion\Extensions;

use Twig\TwigFunction;
use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class TwigExtension extends AbstractExtension
{
    public function getName(): string
    {
        return 'MojarCompanion_Extension';
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('Mojar_get_dashboard_stats', 'Mojar_get_dashboard_stats'),
            new TwigFunction('Mojar_get_recent_orders', 'Mojar_get_recent_orders'),
            new TwigFunction('Mojar_helper_filter_posts', 'Mojar_helper_filter_posts'),
            new TwigFunction('Mojar_helper_is_filtering', 'Mojar_helper_is_filtering'),
            new TwigFunction('Mojar_format_text', 'Mojar_format_text', ['is_safe' => ['html']]),
        ];
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('format_text', [$this, 'formatText'], ['is_safe' => ['html']]),
        ];
    }

    public function formatText($text): string
    {
        if (empty($text)) {
            return '';
        }

        // First escape all HTML to prevent XSS
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        
        // Convert \\ to <br> tags
        $text = str_replace('\\\\', '<br>', $text);
        
        // Convert {text} to <strong>text</strong>
        $text = preg_replace('/\{([^}]+)\}/', '<strong>$1</strong>', $text);
        
        return $text;
    }
}