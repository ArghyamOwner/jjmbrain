<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\EducationBlock;
use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {

            $schools = File::json(base_path('database/schools.json'));

            foreach ($schools as $d) {

                $district = District::where('name', $d['district'])->first();

                $educationBlock = EducationBlock::where('block_name', $d['block'])->first();

                if ($educationBlock) {
                    School::create([
                        'district_id' => $district->id,
                        'education_block_id' => $educationBlock->id,
                        'school_name' => $d['school_name'],
                        'school_code' => $d['school_code'],
                        'category' => $d['category'],
                        // 'location' => $d['location'],
                        'latitude' => $d['latitude'],
                        'longitude' => $d['longitude'],
                        'drink_water' => 'Yes',
                        'hand_pump' => 'Yes',
                        'electricity' => 'Yes',
                    ]);
                }
            }
        });
    }
}
