<?php

namespace MojarCMS\Backend\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use MojarCMS\Backend\Actions\BackupAction;
use MojarCMS\Backend\Actions\EmailAction;
use MojarCMS\Backend\Actions\EnqueueStyleAction;
use MojarCMS\Backend\Actions\MediaAction;
use MojarCMS\Backend\Actions\MenuAction;
use MojarCMS\Backend\Actions\PermissionAction;
use MojarCMS\Backend\Actions\SeoAction;
use MojarCMS\Backend\Actions\SocialLoginAction;
use MojarCMS\Backend\Actions\ToolAction;
use MojarCMS\Backend\Commands\AutoSubmitCommand;
use MojarCMS\Backend\Commands\AutoTagCommand;
use MojarCMS\Backend\Commands\EmailTemplateGenerateCommand;
use MojarCMS\Backend\Commands\ImportTranslationCommand;
use MojarCMS\Backend\Commands\OptimizeTagCommand;
use MojarCMS\Backend\Commands\PermissionGenerateCommand;
use MojarCMS\Backend\Commands\PingFeedCommand;
use MojarCMS\Backend\Commands\Post\GeneratePostUUIDCommand;
use MojarCMS\Backend\Commands\Publish\CMSPublishCommand;
use MojarCMS\Backend\Commands\ThemePublishCommand;
use MojarCMS\Backend\Commands\TransFromEnglish;
use MojarCMS\Backend\Models\Comment;
use MojarCMS\Backend\Models\Menu;
use MojarCMS\Backend\Models\Post;
use MojarCMS\Backend\Models\Taxonomy;
use MojarCMS\Backend\Observers\CommentObserver;
use MojarCMS\Backend\Observers\MenuObserver;
use MojarCMS\Backend\Observers\PostObserver;
use MojarCMS\Backend\Observers\TaxonomyObserver;
use MojarCMS\Backend\Repositories\CommentRepository;
use MojarCMS\Backend\Repositories\CommentRepositoryEloquent;
use MojarCMS\Backend\Repositories\Email\EmailTemplateRepository;
use MojarCMS\Backend\Repositories\Email\EmailTemplateRepositoryEloquent;
use MojarCMS\Backend\Repositories\MediaFileRepository;
use MojarCMS\Backend\Repositories\MediaFileRepositoryEloquent;
use MojarCMS\Backend\Repositories\MediaFolderRepository;
use MojarCMS\Backend\Repositories\MediaFolderRepositoryEloquent;
use MojarCMS\Backend\Repositories\MenuRepository;
use MojarCMS\Backend\Repositories\MenuRepositoryEloquent;
use MojarCMS\Backend\Repositories\NotificationRepository;
use MojarCMS\Backend\Repositories\NotificationRepositoryEloquent;
use MojarCMS\Backend\Repositories\PostRepository;
use MojarCMS\Backend\Repositories\PostRepositoryEloquent;
use MojarCMS\Backend\Repositories\ResourceRepository;
use MojarCMS\Backend\Repositories\ResourceRepositoryEloquent;
use MojarCMS\Backend\Repositories\TaxonomyRepository;
use MojarCMS\Backend\Repositories\TaxonomyRepositoryEloquent;
use MojarCMS\Backend\Repositories\UserRepository;
use MojarCMS\Backend\Repositories\UserRepositoryEloquent;
use MojarCMS\CMS\Facades\ActionRegister;
use MojarCMS\CMS\Http\Middleware\Admin;
use MojarCMS\CMS\Facades\Field;
use MojarCMS\CMS\Support\Macros\RouterMacros;
use MojarCMS\CMS\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public array $bindings = [
        PostRepository::class => PostRepositoryEloquent::class,
        TaxonomyRepository::class => TaxonomyRepositoryEloquent::class,
        UserRepository::class => UserRepositoryEloquent::class,
        MediaFileRepository::class => MediaFileRepositoryEloquent::class,
        MediaFolderRepository::class => MediaFolderRepositoryEloquent::class,
        NotificationRepository::class => NotificationRepositoryEloquent::class,
        CommentRepository::class => CommentRepositoryEloquent::class,
        MenuRepository::class => MenuRepositoryEloquent::class,
        ResourceRepository::class => ResourceRepositoryEloquent::class,
        EmailTemplateRepository::class => EmailTemplateRepositoryEloquent::class,
    ];

    public function boot(): void
    {
        $this->bootMiddlewares();
        $this->bootPublishes();

        Taxonomy::observe(TaxonomyObserver::class);
        Post::observe(PostObserver::class);
        Menu::observe(MenuObserver::class);
        Comment::observe(CommentObserver::class);

        ActionRegister::register(
            [
                MenuAction::class,
                EnqueueStyleAction::class,
                PermissionAction::class,
                SocialLoginAction::class,
                ToolAction::class,
                SeoAction::class,
                BackupAction::class,
                MediaAction::class,
                EmailAction::class,
            ]
        );

        $this->commands(
            [
                PermissionGenerateCommand::class,
                ImportTranslationCommand::class,
                TransFromEnglish::class,
                EmailTemplateGenerateCommand::class,
                ThemePublishCommand::class,
                AutoSubmitCommand::class,
                AutoTagCommand::class,
                OptimizeTagCommand::class,
                PingFeedCommand::class,
                GeneratePostUUIDCommand::class,
                CMSPublishCommand::class,
            ]
        );
    }

    public function register(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cms');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'cms');

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->registerRouteMacros();
        $this->app->booting(
            function () {
                $loader = AliasLoader::getInstance();
                $loader->alias('Field', Field::class);
            }
        );
    }

    protected function bootMiddlewares(): void
    {
        /**
         * @var Router $router
         */
        $router = $this->app['router'];
        $router->aliasMiddleware('admin', Admin::class);
    }

    protected function bootPublishes(): void
    {
        $this->publishes(
            [
                __DIR__ . '/../resources/views' => resource_path('views/vendor/cms'),
            ],
            'cms_views'
        );

        $this->publishes(
            [
                __DIR__ . '/../resources/lang' => resource_path('lang/cms'),
            ],
            'cms_lang'
        );

        $this->publishes(
            [
                __DIR__ . '/../resources/assets/public' => public_path('mc-styles/Mojar'),
            ],
            'cms_assets'
        );
    }

    protected function registerRouteMacros(): void
    {
        Router::mixin(new RouterMacros());
    }
}
