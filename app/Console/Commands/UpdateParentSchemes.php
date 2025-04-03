<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateParentSchemes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-parent-schemes';

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

        $data = File::json(base_path('database/ParentChild.json'));
        $progressBar = $this->output->createProgressBar(count($data));
        $this->line('Updating Parent Child mapping of schemes...');
        $progressBar->start();
        $notFoundSchemes = 0;

        foreach ($data as $row) {
            $parentScheme = Scheme::where('old_scheme_id', $row['parent_id'])->first();
            if ($parentScheme) {
                Scheme::where('old_scheme_id', $row['child_id'])->update([
                    'parent_id' => $parentScheme->id,
                ]);
            }
            $progressBar->advance();
        }
        $progressBar->finish();
        $this->line('');
        $this->info('Updated Successfully!');

    }
}
