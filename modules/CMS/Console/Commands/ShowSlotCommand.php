<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\CMS\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ShowSlotCommand extends Command
{
    protected $signature = 'Mojarcms:command-slots';

    protected $description = 'Show list command slots.';

    public function handle()
    {
        $storage = Storage::disk('local');

        $files = File::files($storage->path('command-slots'));

        $rows = [];
        $index = 1;
        foreach ($files as $file) {
            $data = json_decode($file->getContents(), true);

            foreach ($data as $item) {
                $rows[] = [$index, $item['command'], $item['slot'], $item['date']];
                $index++;
            }
        }

        $this->table(['#', 'Command', 'Slot', 'Run Date'], $rows);
    }
}
