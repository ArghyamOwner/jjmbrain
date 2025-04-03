<?php

namespace App\Console\Commands;

use App\Models\School;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateBhawanipurBarpetaSchools extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-bhawanipur-barpeta-schools';

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
        $schools = File::json(base_path("database/udise.json"));
        $progressBar = $this->output->createProgressBar(count($schools));
        $this->line('Schools importing...');
        $progressBar->start();

        foreach ($schools as $d) {
            $school = School::where("school_code", $d["Udise_Code"])->first();
            if (!$school) {
                $this->line('');
                $this->line("School Code Not Found - " . $d["Udise_Code"]);
            }
            $school->update([
                'education_block_id' => '01h8kj80dy3hry9axd8yh1dbf8',
                'district_id' => 77,
            ]);
            $progressBar->advance();
        }
        $progressBar->finish();
        $this->line('');

        // the info method will display in the console as green colored text:
        $this->info('Imported Successfully!');
    }
}
