<?php

namespace MojarCMS\CMS\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;
use MojarCMS\API\Providers\APIServiceProvider;
use MojarCMS\Backend\Providers\BackendServiceProvider;
use MojarCMS\Backend\Repositories\PostRepository;
use MojarCMS\Backend\Repositories\TaxonomyRepository;
use MojarCMS\CMS\Contracts\ActionRegisterContract;
use MojarCMS\CMS\Contracts\BackendMessageContract;
use MojarCMS\CMS\Contracts\CacheGroupContract;
use MojarCMS\CMS\Contracts\ConfigContract;
use MojarCMS\CMS\Contracts\EventyContract;
use MojarCMS\CMS\Contracts\Field;
use MojarCMS\CMS\Contracts\GlobalDataContract;
use MojarCMS\CMS\Contracts\GoogleTranslate as GoogleTranslateContract;
use MojarCMS\CMS\Contracts\HookActionContract;
use MojarCMS\CMS\Contracts\MojarApiContract;
use MojarCMS\CMS\Contracts\MCQueryContract;
use MojarCMS\CMS\Contracts\LocalPluginRepositoryContract;
use MojarCMS\CMS\Contracts\LocalThemeRepositoryContract;
use MojarCMS\CMS\Contracts\MacroableModelContract;
use MojarCMS\CMS\Contracts\Media\Media as MediaContract;
use MojarCMS\CMS\Contracts\OverwriteConfigContract;
use MojarCMS\CMS\Contracts\PostImporterContract;
use MojarCMS\CMS\Contracts\PostManagerContract;
use MojarCMS\CMS\Contracts\ShortCode as ShortCodeContract;
use MojarCMS\CMS\Contracts\ShortCodeCompiler as ShortCodeCompilerContract;
use MojarCMS\CMS\Contracts\StorageDataContract;
use MojarCMS\CMS\Contracts\TableGroupContract;
use MojarCMS\CMS\Contracts\ThemeConfigContract;
use MojarCMS\CMS\Contracts\TranslationFinder as TranslationFinderContract;
use MojarCMS\CMS\Contracts\TranslationManager as TranslationManagerContract;
use MojarCMS\CMS\Contracts\XssCleanerContract;
use MojarCMS\CMS\Extension\Custom;
use MojarCMS\CMS\Facades\OverwriteConfig;
use MojarCMS\CMS\Support\ActionRegister;
use MojarCMS\CMS\Support\CacheGroup;
use MojarCMS\CMS\Support\Config as DbConfig;
use MojarCMS\CMS\Support\DatabaseTableGroup;
use MojarCMS\CMS\Support\GlobalData;
use MojarCMS\CMS\Support\GoogleTranslate;
use MojarCMS\CMS\Support\HookAction;
use MojarCMS\CMS\Support\Html\Field as HtmlField;
use MojarCMS\CMS\Support\Imports\PostImporter;
use MojarCMS\CMS\Support\MojarApi;
use MojarCMS\CMS\Support\MCQuery;
use MojarCMS\CMS\Support\MacroableModel;
use MojarCMS\CMS\Support\Manager\BackendMessageManager;
use MojarCMS\CMS\Support\Manager\PostManager;
use MojarCMS\CMS\Support\Manager\TranslationManager;
use MojarCMS\CMS\Support\Media\Media;
use MojarCMS\CMS\Support\ShortCode\Compilers\ShortCodeCompiler;
use MojarCMS\CMS\Support\ShortCode\ShortCode;
use MojarCMS\CMS\Support\StorageData;
use MojarCMS\CMS\Support\Theme\ThemeConfig;
use MojarCMS\CMS\Support\Translations\TranslationFinder;
use MojarCMS\CMS\Support\Validators\ModelExists;
use MojarCMS\CMS\Support\Validators\ModelUnique;
use MojarCMS\CMS\Support\XssCleaner;
use MojarCMS\DevTool\Providers\DevToolServiceProvider;
use MojarCMS\Frontend\Providers\FrontendServiceProvider;
use MojarCMS\Multilang\Providers\MultilangServiceProvider;
use MojarCMS\Network\Providers\NetworkServiceProvider;
use MojarCMS\Translation\Providers\TranslationServiceProvider;
use Laravel\Passport\Passport;
use TwigBridge\Facade\Twig;
use Sentry\Laravel\ServiceProvider as SentryServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
    protected string $basePath = __DIR__ . '/..';

    public function boot()
    {
        $this->bootMigrations();
        $this->bootPublishes();
        $this->configureRateLimiting();

        Validator::extend(
            'recaptcha',
            '\MojarCMS\CMS\Support\Validators\ReCaptchaValidator@validate'
        );

        Validator::extend(
            'domain',
            '\MojarCMS\CMS\Support\Validators\DomainValidator@validate'
        );

        Rule::macro(
            'modelExists',
            function (
                string $modelClass,
                string $modelAttribute = 'id',
                callable $callback = null
            ) {
                return new ModelExists($modelClass, $modelAttribute, $callback);
            }
        );

        Rule::macro(
            'modelUnique',
            function (
                string $modelClass,
                string $modelAttribute = 'id',
                callable $callback = null
            ) {
                return new ModelUnique($modelClass, $modelAttribute, $callback);
            }
        );

        // Prevent lazy loading in local environment
        //Model::preventLazyLoading(!$this->app->isProduction());

        Schema::defaultStringLength(150);

        Twig::addExtension(new Custom());

        Paginator::useBootstrapFive();

        OverwriteConfig::init();

        /*$this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('Mojarcms:update')->everyMinute();
        });*/
    }

    public function register(): void
    {
        $this->registerSingleton();
        $this->registerConfigs();
        $this->registerProviders();
        Passport::ignoreMigrations();
    }

    protected function registerConfigs()
    {
        $this->mergeConfigFrom(
            $this->basePath . '/config/mojar.php',
            'mojar'
        );

        $this->mergeConfigFrom(
            $this->basePath . '/config/locales.php',
            'locales'
        );

        $this->mergeConfigFrom(
            $this->basePath . '/config/countries.php',
            'countries'
        );

        $this->mergeConfigFrom(
            $this->basePath . '/config/installer.php',
            'installer'
        );

        $this->mergeConfigFrom(
            $this->basePath . '/config/network.php',
            'network'
        );
    }

    protected function bootMigrations()
    {
        $mainPath = $this->basePath . '/Database/migrations';
        $directories = glob($mainPath . '/*', GLOB_ONLYDIR);
        $paths = array_merge([$mainPath], $directories);
        $this->loadMigrationsFrom($paths);
    }

    protected function bootPublishes()
    {
        $this->publishes(
            [
                $this->basePath . '/config/mojar.php' => base_path('config/mojar.php'),
                $this->basePath . '/config/network.php' => base_path('config/network.php'),
            ],
            'cms_config'
        );
    }

    protected function registerSingleton()
    {
        $this->app->singleton(
            MacroableModelContract::class,
            function () {
                return new MacroableModel();
            }
        );

        $this->app->singleton(
            ActionRegisterContract::class,
            function ($app) {
                return new ActionRegister($app);
            }
        );

        $this->app->singleton(
            ConfigContract::class,
            function ($app) {
                return new DbConfig($app, $app['cache']);
            }
        );

        $this->app->singleton(
            ThemeConfigContract::class,
            function ($app) {
                return new ThemeConfig($app, mc_current_theme());
            }
        );

        $this->app->singleton(
            HookActionContract::class,
            function ($app) {
                return new HookAction(
                    $app[EventyContract::class],
                    $app[GlobalDataContract::class]
                );
            }
        );

        $this->app->singleton(
            GlobalDataContract::class,
            function () {
                return new GlobalData();
            }
        );

        $this->app->singleton(
            XssCleanerContract::class,
            function () {
                return new XssCleaner();
            }
        );

        $this->app->singleton(
            CacheGroupContract::class,
            function ($app) {
                return new CacheGroup($app['cache']);
            }
        );

        $this->app->singleton(
            OverwriteConfigContract::class,
            function ($app) {
                return new DbConfig\OverwriteConfig(
                    $app['config'],
                    $app[ConfigContract::class],
                    $app['request'],
                    $app['translator']
                );
            }
        );

        $this->app->singleton(
            StorageDataContract::class,
            function () {
                return new StorageData();
            }
        );

        $this->app->singleton(
            TableGroupContract::class,
            function ($app) {
                return new DatabaseTableGroup(
                    $app['migrator']
                );
            }
        );

        $this->app->singleton(
            BackendMessageContract::class,
            function ($app) {
                return new BackendMessageManager(
                    $app[ConfigContract::class]
                );
            }
        );

        $this->app->singleton(
            MojarApiContract::class,
            function ($app) {
                return new MojarApi(
                    $app[ConfigContract::class]
                );
            }
        );

        $this->app->singleton(
            MCQueryContract::class,
            function ($app) {
                return new MCQuery($app['db']);
            }
        );

        $this->app->singleton(
            PostManagerContract::class,
            function ($app) {
                return new PostManager(
                    $app[PostRepository::class]
                );
            }
        );

        $this->app->singleton(
            PostImporterContract::class,
            function ($app) {
                return new PostImporter(
                    $app[PostManagerContract::class],
                    $app[HookActionContract::class],
                    $app[TaxonomyRepository::class]
                );
            }
        );

        $this->app->singleton(
            Field::class,
            function ($app) {
                return new HtmlField();
            }
        );

        $this->app->singleton(
            ShortCodeCompilerContract::class,
            function ($app) {
                return new ShortCodeCompiler();
            }
        );

        $this->app->singleton(
            ShortCodeContract::class,
            function ($app) {
                return new ShortCode($app[ShortCodeCompilerContract::class]);
            }
        );

        $this->app->singleton(MediaContract::class, Media::class);

        $this->app->singleton(
            TranslationFinderContract::class,
            function ($app) {
                return new TranslationFinder();
            }
        );

        $this->app->singleton(
            TranslationManagerContract::class,
            function ($app) {
                return new TranslationManager(
                    $app[LocalPluginRepositoryContract::class],
                    $app[LocalThemeRepositoryContract::class],
                    $app[TranslationFinderContract::class],
                    $app[GoogleTranslateContract::class]
                );
            }
        );

        $this->app->bind(
            GoogleTranslateContract::class,
            fn($app) => new GoogleTranslate($app[\Illuminate\Contracts\Filesystem\Factory::class])
        );
    }

    protected function registerProviders()
    {
        $this->app->register(RepositoryServiceProvider::class);
        if (config('network.enable')) {
            $this->app->register(NetworkServiceProvider::class);
        }

        $this->app->register(HookActionServiceProvider::class);
        $this->app->register(PermissionServiceProvider::class);
        $this->app->register(PerformanceServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(PluginServiceProvider::class);
        $this->app->register(ConsoleServiceProvider::class);
        $this->app->register(NotificationServiceProvider::class);
        $this->app->register(DevToolServiceProvider::class);
        $this->app->register(ThemeServiceProvider::class);
        //$this->app->register(MultilangServiceProvider::class);
        $this->app->register(BackendServiceProvider::class);
        $this->app->register(FrontendServiceProvider::class);
        $this->app->register(ShortCodeServiceProvider::class);
        $this->app->register(SentryServiceProvider::class);

        if (config('mojar.translation.enable')) {
            $this->app->register(TranslationServiceProvider::class);
        }

        if (config('mojar.api.enable')) {
            $this->app->register(APIServiceProvider::class);
        }
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for(
            'api',
            function (Request $request) {
                return Limit::perMinute(120)
                    ->by($request->user()?->id ?: get_client_ip());
            }
        );
    }
}
