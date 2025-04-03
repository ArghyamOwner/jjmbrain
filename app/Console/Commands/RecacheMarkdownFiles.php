<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Blade;

class RecacheMarkdownFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'markdown:recache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recache the markdown files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $files = glob(resource_path('markdown/*.md'));
        foreach ($files as $file) {
            $fileName = basename($file, '.md');
            cache()->forget($fileName);

            $markdown = file_get_contents($file);
            $html = Blade::render(Str::markdown($markdown));
            cache()->rememberForever($fileName, function () use ($html) {
                return $html;
            });
        }

        $this->info('Markdown files recached successfully!');
    }
}
