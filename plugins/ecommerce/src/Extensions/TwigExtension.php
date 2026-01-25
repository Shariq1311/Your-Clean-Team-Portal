<?php

namespace Mojahid\Ecommerce\Extensions;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class TwigExtension extends AbstractExtension
{
    public function getName(): string
    {
        return 'App_Extension_Ecommerce_Custom';
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('ecom_get_cart_items', 'ecom_get_cart_items'),
            new TwigFunction('ecom_get_payment_methods', 'ecom_get_payment_methods'),
            new TwigFunction('ecom_get_cart', 'ecom_get_cart'),
            new TwigFunction('ecom_get_wishlist', 'ecom_get_wishlist'),
            new TwigFunction('ecom_get_wishlist_items', 'ecom_get_wishlist_items'),
            new TwigFunction('ecom_wishlist_has_item', 'ecom_wishlist_has_item'),
            new TwigFunction('ecom_price_with_unit', 'ecom_price_with_unit'),
            new TwigFunction('ecom_price_with_currency', 'ecom_price_with_currency'),
            new TwigFunction('ecom_convert_price', 'ecom_convert_price'),
            new TwigFunction('ecom_format_price', 'ecom_format_price'),
            new TwigFunction('ecom_get_current_currency', 'ecom_get_current_currency'),
            new TwigFunction('ecom_get_current_currency_code', 'ecom_get_current_currency_code'),
            new TwigFunction('ecom_get_available_currencies', 'ecom_get_available_currencies'),
            new TwigFunction('ecom_currency_symbol', 'ecom_currency_symbol'),
            new TwigFunction('ecom_get_default_currency', 'ecom_get_default_currency'),
            new TwigFunction('ecom_get_reviews', 'ecom_get_reviews'),
            new TwigFunction('ecom_get_average_rating', 'ecom_get_average_rating'),
            new TwigFunction('ecom_get_review_stats', 'ecom_get_review_stats'),
            new TwigFunction('ecom_products_price_bounds', 'ecom_products_price_bounds'),
            new TwigFunction('buildFilterUrl', 'buildFilterUrl'),
        ];
    }
}
