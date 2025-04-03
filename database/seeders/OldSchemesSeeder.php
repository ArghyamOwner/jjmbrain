<?php

namespace Database\Seeders;

use App\Models\Scheme;
use App\Models\Division;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OldSchemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::transaction(function () {
                $schemes = File::json(base_path('database/schemes.json'));
    
                foreach ($schemes as $scheme) {    
                    $division = Division::where('name', $scheme['division_name'])->first();

                    if ($division) {
                        $hasTeaGarden = match($scheme['tea_garden']) {
                            'Yes' => true,
                            'No' => false,
                            default => false
                        };
        
                        Scheme::create([
                            'division_id' => $division->id,
                            'district_id' => $scheme['district'],
                            'block_id' => $scheme['block'] == '' ? null : intval($scheme['block']),
                            'name' => $scheme['scheme_name'],
                            'old_scheme_id' => $scheme['scheme_id'],
                            'scheme_type' => $scheme['scheme_type'],
                            'scheme_status' => $scheme['status'],
                            'approved_on' => $scheme['approved_in'],
                            'imis_id' => $scheme['scheme_id'],
                            'has_tea_garden' => $hasTeaGarden,
                            'slssc_year' => $scheme['slssc_year'],
                        ]);
                    } else {
                        Log::info($scheme['division_name']);
                    }
                }
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
