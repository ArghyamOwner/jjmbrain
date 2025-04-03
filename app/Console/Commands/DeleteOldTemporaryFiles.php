<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteOldTemporaryFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-temporary-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = storage_path('app/public/tmp-uploads');

        // Check if the directory exists, if not exit
        if (!File::exists($directory)) {
            $this->info("Directory does not exist: {$directory}");
            return 0; // Exit since the directory doesn't exist
        }

        $files = File::files($directory);
        $now = Carbon::now();
        foreach ($files as $file) {
            if ($now->diffInDays(Carbon::createFromTimestamp($file->getMTime())) > 2) {
                File::delete($file);
                $this->info("Deleted: {$file->getRealPath()}");
            }
        }
        return 0;
    }
}
