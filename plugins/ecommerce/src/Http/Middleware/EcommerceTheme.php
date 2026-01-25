<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    Mojarcms/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojarcms.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Http\Resources\CartResource;

class EcommerceTheme
{
    public function handle($request, Closure $next)
    {
        $cart = app(CartManagerContract::class)->find();

        View::share(
            [
                'cart' => (new CartResource($cart))
                    ->toArray($request),
            ]
        );

        return $next($request);
    }
}
