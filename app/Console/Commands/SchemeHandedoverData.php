<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SchemeHandedoverData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scheme-handedover-data';

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
        $datas = File::json(base_path('database/handedover.json'));

        $progressBar = $this->output->createProgressBar(count($datas));

        $this->line('Updating Handed-over data of schemes...');

        $progressBar->start();

        foreach ($datas as $data) {

            $scheme = Scheme::where('imis_id', $data['imis_id'])->latest()->first();

            if($scheme){
                $scheme->update([
                    'work_status' => "handed-over",
                    'handover_date' => $data['handedover_date'],
                ]);
            }

            $progressBar->advance();
        }
        $progressBar->finish();
        $this->line('');

        // the info method will display in the console as green colored text:
        $this->info('Imported Successfully!');
    }
}
