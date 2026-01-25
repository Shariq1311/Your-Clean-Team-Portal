<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    Mojarcms/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojarcms.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Contracts;

use Mojahid\Ecommerce\Models\Wishlist;

interface WishlistManagerContract
{
    public function find(string|Wishlist $wishlist = null): WishlistContract;

    public function getCodeCurrentWishlist(): string;
} 