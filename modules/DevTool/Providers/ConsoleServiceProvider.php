<?php

namespace MojarCMS\DevTool\Providers;

use Illuminate\Support\ServiceProvider;
use MojarCMS\DevTool\Commands\CacheSizeCommand;
use MojarCMS\DevTool\Commands\FindFillableColumnCommand;
use MojarCMS\DevTool\Commands\MakeAdminCommand;
use MojarCMS\DevTool\Commands\Plugin;
use MojarCMS\DevTool\Commands\Plugin\ActionMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\CommandMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\ControllerMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\DisableCommand;
use MojarCMS\DevTool\Commands\Plugin\EnableCommand;
use MojarCMS\DevTool\Commands\Plugin\EventMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\InstallCommand as PluginInstallCommand;
use MojarCMS\DevTool\Commands\Plugin\JobMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\ListCommand;
use MojarCMS\DevTool\Commands\Plugin\ListenerMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\MiddlewareMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\ModelMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\ModuleDeleteCommand;
use MojarCMS\DevTool\Commands\Plugin\ModuleMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\ProviderMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\Publish\PublishCommand;
use MojarCMS\DevTool\Commands\Plugin\RequestMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\ResourceMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\RouteProviderMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\RuleMakeCommand;
use MojarCMS\DevTool\Commands\Plugin\SeedCommand;
use MojarCMS\DevTool\Commands\Resource;
use MojarCMS\DevTool\Commands\Theme;

class ConsoleServiceProvider extends ServiceProvider
{
    protected array $commands = [
        PluginInstallCommand::class,
        CommandMakeCommand::class,
        ControllerMakeCommand::class,
        DisableCommand::class,
        //DumpCommand::class,
        EnableCommand::class,
        EventMakeCommand::class,
        JobMakeCommand::class,
        ListenerMakeCommand::class,
        PublishCommand::class,
        //MailMakeCommand::class,
        MiddlewareMakeCommand::class,
        //NotificationMakeCommand::class,
        ProviderMakeCommand::class,
        RouteProviderMakeCommand::class,
        ListCommand::class,
        ModuleDeleteCommand::class,
        ModuleMakeCommand::class,
        //FactoryMakeCommand::class,
        //PolicyMakeCommand::class,
        RequestMakeCommand::class,
        RuleMakeCommand::class,
        Plugin\Migration\MigrateCommand::class,
        Plugin\Migration\MigrateRefreshCommand::class,
        Plugin\Migration\MigrateResetCommand::class,
        Plugin\Migration\MigrateRollbackCommand::class,
        Plugin\Migration\MigrateStatusCommand::class,
        Plugin\Migration\MigrationMakeCommand::class,
        ModelMakeCommand::class,
        SeedCommand::class,
        Plugin\SeedMakeCommand::class,
        ResourceMakeCommand::class,
        Plugin\TestMakeCommand::class,
        Theme\ThemeGeneratorCommand::class,
        Theme\ThemeListCommand::class,
        ActionMakeCommand::class,
        Plugin\DatatableMakeCommand::class,
        Resource\MojarResouceMakeCommand::class,
        MakeAdminCommand::class,
        Theme\GenerateDataThemeCommand::class,
        Theme\DownloadStyleCommand::class,
        Theme\DownloadTemplateCommand::class,
        Plugin\UpdateCommand::class,
        Theme\ThemeUpdateCommand::class,
        Theme\MakeBlockCommand::class,
        CacheSizeCommand::class,
        Plugin\Translation\ImportTranslationCommand::class,
        Plugin\Translation\TranslateViaGoogleCommand::class,
        Plugin\Translation\ExportTranslationCommand::class,
        Plugin\RepositoryMakeCommand::class,
        Theme\ExportTranslationCommand::class,
        Theme\ImportTranslationCommand::class,
        Theme\TranslateViaGoogleCommand::class,
        FindFillableColumnCommand::class,
        Resource\CRUDMakeCommand::class,
    ];

    /**
     * Register the commands.
     */
    public function register(): void
    {
        $this->commands($this->commands);

        // Register UI & router dev-tools
        if (is_dev_tool_enable()) {
            $this->app->register(UIServiceProvider::class);
            $this->app->register(RouteServiceProvider::class);
        }
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return $this->commands;
    }
}
