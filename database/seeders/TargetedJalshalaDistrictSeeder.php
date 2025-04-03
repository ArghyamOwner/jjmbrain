<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TargetedJalshalaDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $districtWithJalshalas = File::json(base_path('database/targetedjalshala.json'));

            foreach($districtWithJalshalas as $data) {
                    
                $district = District::where('name', $data['District'])->first();

                if($district) {
                    $district->update([
                        'phase2_targeted_jalshala' => $data['Jalshalas']
                    ]);
                }
            }
        });
    }
}