<?php

namespace App\Console\Commands;

use App\Models\District;
use App\Models\EducationBlock;
use App\Models\School;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ImportSchoolWithLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-school-with-location';

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
        try {
            DB::transaction(function () {
                $schools = File::json(base_path("database/schools.json"));

                $progressBar = $this->output->createProgressBar(count($schools));

                $this->line('Schools importing...');

                $progressBar->start();

                foreach ($schools as $d) {
                    $district = District::where("name", $d["district_name"])->first();
                    if (!$district) {
                        dd("District Not Found - " . $d["district_name"]);
                    }

                    $educationBlock = EducationBlock::query()
                        ->where("block_name", $d["block_name"])
                        ->where("district_id", $district->id)
                        ->first();
                    if (!$educationBlock) {
                        dd("Block Not Found - " . $d["block_name"] . $d["district_name"]);
                    }

                    $exists = School::query()
                        ->where("school_code", $d["udise_code"])
                        ->where("education_block_id", $educationBlock->id)
                        ->first();

                    if ($exists) {
                        $exists->update([
                            "latitude" => $d["Latitude"],
                            "longitude" => $d["Longitude"],
                        ]);
                    } else {
                        School::create([
                            "district_id" => $district->id,
                            "education_block_id" => $educationBlock->id,
                            "school_name" => $d["school_name"],
                            "school_code" => $d["udise_code"],
                            "category" => $d["category"],
                            "latitude" => $d["Latitude"],
                            "longitude" => $d["Longitude"],
                            // 'location' => $d['location'],
                            "drink_water" => "Yes",
                            "hand_pump" => "Yes",
                            "electricity" => "Yes",
                        ]);
                    }
                    $progressBar->advance();
                }
                $progressBar->finish();

                $this->line('');

                // the info method will display in the console as green colored text:
                $this->info('Imported Successfully!');
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
