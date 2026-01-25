<?php

namespace Mojahid\Ecommerce\Providers;

use MojarCMS\CMS\Support\ServiceProvider;
use MojarCMS\CMS\Facades\ActionRegister;
use MojarCMS\CMS\Facades\MacroableModel;
use Mojahid\Ecommerce\Supports\Payment;
use Mojahid\Ecommerce\Actions\ConfigAction;
use Mojahid\Ecommerce\Actions\EcommerceAction;
use Mojahid\Ecommerce\Actions\MenuAction;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Contracts\WishlistContract;
use Mojahid\Ecommerce\Contracts\WishlistManagerContract;
use Mojahid\Ecommerce\Contracts\OrderCreaterContract;
use Mojahid\Ecommerce\Contracts\OrderManagerContract;
use Mojahid\Ecommerce\Supports\Creaters\OrderCreater;
use Mojahid\Ecommerce\Supports\Manager\AddonManager;
use Mojahid\Ecommerce\Supports\Manager\CartManager;
use Mojahid\Ecommerce\Supports\Manager\WishlistManager;
use Mojahid\Ecommerce\Supports\Manager\OrderManager;
use Mojahid\Ecommerce\Repositories\CartRepository;
use Mojahid\Ecommerce\Repositories\CartRepositoryEloquent;
use Mojahid\Ecommerce\Repositories\WishlistRepository;
use Mojahid\Ecommerce\Repositories\WishlistRepositoryEloquent;
use Mojahid\Ecommerce\Repositories\ProductRepository;
use Mojahid\Ecommerce\Repositories\ProductRepositoryEloquent;
use Mojahid\Ecommerce\Repositories\VariantRepositoryEloquent;
use MojarCMS\Backend\Models\Post;
use Mojahid\Ecommerce\Actions\EcommercePostTypeAction;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Models\OrderItem;
use Mojahid\Ecommerce\Models\ProductVariant;
use Mojahid\Ecommerce\Http\Middleware\EcommerceTheme;
use Mojahid\Ecommerce\Http\Middleware\CheckVendorStatus;
use Illuminate\Support\Facades\Route;
use TwigBridge\Facade\Twig;
use Mojahid\Ecommerce\Extensions\TwigExtension;
use Mojahid\Ecommerce\Actions\EcommerceReviewAction;
use Mojahid\Ecommerce\Actions\EcommercePermissonsAction;
use Mojahid\Ecommerce\Policies\OrderPolicy;
use Mojahid\Ecommerce\Models\VendorBalance;
use Mojahid\Ecommerce\Models\VendorEarning;
use Mojahid\Ecommerce\Models\VendorWithdrawal;
use Mojahid\Ecommerce\Policies\VendorBalancePolicy;
use Mojahid\Ecommerce\Policies\VendorEarningPolicy;
use Mojahid\Ecommerce\Policies\VendorWithdrawalPolicy;
use Mojahid\Ecommerce\Policies\OrderItemPolicy;
use Mojahid\Ecommerce\Console\Commands\UpdateExchangeRatesCommand;

class EcommerceServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CartRepository::class => CartRepositoryEloquent::class,
        WishlistRepository::class => WishlistRepositoryEloquent::class,
        VariantRepositoryEloquent::class => VariantRepositoryEloquent::class,
        ProductRepository::class => ProductRepositoryEloquent::class,
    ];

    public array $policies = [
        Order::class => OrderPolicy::class,
        VendorBalance::class => VendorBalancePolicy::class,
        VendorEarning::class => VendorEarningPolicy::class,
        VendorWithdrawal::class => VendorWithdrawalPolicy::class,
        OrderItem::class => OrderItemPolicy::class,
    ];

    public function boot()
    {
        Route::pushMiddlewareToGroup('theme', EcommerceTheme::class);
        
        // Register vendor status middleware
        Route::pushMiddlewareToGroup('web', CheckVendorStatus::class);

        Twig::addExtension(new TwigExtension());

        ActionRegister::register([
            EcommercePermissonsAction::class,
            EcommerceAction::class,
            MenuAction::class,
            ConfigAction::class,
            EcommerceReviewAction::class,
        ]);

        if (get_config('ecom_enable_products', true)) {
            ActionRegister::register([
                EcommercePostTypeAction::class,
            ]);
        }

        // $addonManager = app(AddonManager::class);
        // $addonManager->loadAddons();
        // $addonManager->initAddons();

        MacroableModel::addMacro(
            Post::class,
            'orderItems',
            function () {
                /**
                 * @var Post $this
                 */
                return $this->hasMany(
                    OrderItem::class,
                    'product_id',
                    'id'
                );
            }
        );

        MacroableModel::addMacro(
            Post::class,
            'orders',
            function () {
                /**
                 * @var Post $this
                 */
                return $this->belongsToMany(
                    Order::class,
                    OrderItem::getTableName(),
                    'product_id',
                    'order_id'
                );
            }
        );

        MacroableModel::addMacro(
            Post::class,
            'variants',
            function () {
                /**
                 * @var Post $this
                 */
                return $this->hasMany(
                    ProductVariant::class,
                    'post_id',
                    'id'
                );
            }
        );

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/ecommerce.php',
            'ecommerce'
        );

        // $pluginPath = __DIR__ . '/../../';
        // if (file_exists($pluginPath . 'vendor/autoload.php')) {
        //     require_once $pluginPath . 'vendor/autoload.php';
        // }

        $this->app->singleton(
            CartManagerContract::class,
            function () {
                return new CartManager();
            }
        );

        $this->app->bind(
            CartContract::class,
            config('ecommerce.cart')
        );

        $this->app->singleton(
            WishlistManagerContract::class,
            function () {
                return new WishlistManager();
            }
        );

        $this->app->bind(
            WishlistContract::class,
            config('ecommerce.wishlist')
        );

        $this->app->singleton(
            OrderCreaterContract::class,
            OrderCreater::class
        );

        $this->app->singleton(
            OrderManagerContract::class,
            function ($app) {
                return new OrderManager(
                    $app[OrderCreaterContract::class],
                    app(Payment::class)
                );
            }
        );

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                UpdateExchangeRatesCommand::class,
            ]);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
