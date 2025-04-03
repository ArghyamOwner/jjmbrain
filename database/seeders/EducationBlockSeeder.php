<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\EducationBlock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EducationBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {

            $blocks = File::json(base_path('database/educationblocks.json'));

            foreach ($blocks as $d) {

                $district = District::where('name', $d['district'])->first();

                if ($district) {
                    EducationBlock::create([
                        'district_id' => $district->id,
                        'block_name' => $d['block'],
                        'block_code' => $d['code']
                    ]);
                }
            }
        });
    }
}
