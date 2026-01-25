<?php

namespace MojarCMS\Backend\Http\Controllers\Installer;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use MojarCMS\CMS\Http\Controllers\Controller;
use MojarCMS\CMS\Support\Manager\DatabaseManager;

class DatabaseController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private DatabaseManager $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Import SQL file with demo data instead of running migrations.
     *
     * @return RedirectResponse
     * @throws \Exception|\Throwable
     */
    public function database(): RedirectResponse
    {
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', '300');
        // Check for theme-specific database file
        $theme = config('Mojarcms.theme.theme', 'default');
        $themeDbFile = base_path("database-{$theme}.sql");
        
        if (File::exists($themeDbFile)) {
            $this->databaseManager->setSqlFilePath($themeDbFile);
        } elseif (File::exists(base_path('database.sql'))) {
            $this->databaseManager->setSqlFilePath(base_path('database.sql'));
        }

        $response = $this->databaseManager->run();

        return redirect()
            ->route('installer.admin')
            ->with(['message' => $response]);
    }
}
