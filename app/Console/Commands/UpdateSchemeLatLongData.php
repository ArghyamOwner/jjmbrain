<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UpdateSchemeLatLongData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-scheme-lat-long-data';

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

        DB::transaction(function () {
            $datas = File::json(base_path('database/scheme_LAT_LONG.json'));
            $progressBar = $this->output->createProgressBar(count($datas));
            $this->line('Updating Location data of schemes...');
            $progressBar->start();
            $notFoundSchemes = 0;
            foreach ($datas as $data) {
                $schemes = Scheme::where('imis_id', $data['imis_id'])
                ->whereNotNull(['latitude', 'longitude'])->get();
                if($schemes->isNotEmpty()){
                    $schemes->toQuery()->update([
                        'latitude' => $data['Latitude'],
                        'longitude' => $data['Longitude'],
                    ]);
                }else{
                    ++$notFoundSchemes;
                    $this->info('Not Found Scheme or has data : '.$data['imis_id']);
                }
                $progressBar->advance();
            }
            $progressBar->finish();
            $this->line('');
            $this->info('Not Found Schemes : '.$notFoundSchemes);
            $this->line('');
            // the info method will display in the console as green colored text:
            $this->info('Updated Successfully!');
        });
    }
}
