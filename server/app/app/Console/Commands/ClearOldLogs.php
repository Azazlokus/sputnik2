<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearOldLogs extends Command
{
    protected $signature = 'logs:clear';
    protected $description = 'Clear old log files';

    public function handle()
    {
        $logsPath = storage_path('logs');
        $files = File::glob("$logsPath/*.log");

        $daysToKeep = 0; // Количество дней, логи старше которых будут удалены

        foreach ($files as $file) {
            if (File::lastModified($file) < now()->subDays($daysToKeep)->getTimestamp()) {
                File::delete($file);
                $this->info("Deleted: $file");
            }
        }
    }
}
