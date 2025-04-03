<?php

namespace Database\Seeders;

use App\Models\Zone;
use App\Models\Circle;
use App\Models\Division;
use App\Models\Subdivision;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Log;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        DB::table('zones')->truncate();
        DB::table('circles')->truncate();
        DB::table('divisions')->truncate();
        DB::table('subdivisions')->truncate();

        DB::transaction(function () {
            $zones = File::json(public_path('test.json'));

            foreach($zones as $zoneName => $circles) {
                $zone = Zone::create(['name' => $zoneName]);
    
                foreach($circles as $circleName => $divisions) {
                    if ($circleName !== 'No Circle') {
                        $circle = Circle::create([
                            'zone_id' => $zone->id,
                            'name' => $circleName
                        ]);
                    }

                    foreach($divisions as $divisionName => $subdivisions) {
                        $division = Division::create([
                            'zone_id' => $zone->id,
                            'circle_id' => $circleName !== 'No Circle' ? $circle->id : null,
                            'name' => $divisionName
                        ]);

                        foreach($subdivisions as $subdivision) {
                            Log::info($subdivision);
                            Subdivision::create([
                                'zone_id' => $zone->id,
                                'division_id' => $division->id,
                                'name' => $subdivision
                            ]);
                        }
                    }
                }
            }
        });
    }
}
