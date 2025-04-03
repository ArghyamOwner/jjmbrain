<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DistrictBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('districts')->truncate();
        
        DB::transaction(function () {
            $districts = File::json(base_path('database/districtblocks.json'));

            foreach($districts as $districtName => $blocks) {
                $district = District::create([
                    'name' => $districtName
                ]);

                foreach($blocks as $block) {
                    Block::create([
                        'district_id' => $district->id,
                        'name' => $block
                    ]);
                }
            }
        });
    }
}