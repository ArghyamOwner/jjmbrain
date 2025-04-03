<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Scheme;
use App\Models\District;
use App\Models\Division;
use App\Enums\SchemeTypes;
use App\Enums\SchemeStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SchemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schemes')->truncate();

        DB::transaction(function () {
            $schemes = File::json(public_path('schemes.json'));

            foreach($schemes as $scheme) {
                $division = Division::where('name', $scheme['Division'])->first();

                $status = match($scheme['Status']) {
                    'Alloted' => SchemeStatus::ALLOTED,
                    'Active' => SchemeStatus::ACTIVE,
                };

                $district = District::where('name', strtolower($scheme['District']))->first();
                $block = Block::where('name', strtolower($scheme['Block']))->first();

                Scheme::create([
                    'division_id' => $division->id,
                    'district_id' => $district->id,
                    'block_id' => $block->id,
                    'name' => $scheme['Scheme Name'],
                    'scheme_uin' => $scheme['Scheme ID'],
                    'scheme_type' => SchemeTypes::NEW_SCHEME,
                    'scheme_status' => $status,
                    'financial_year' => $scheme['Financial Year'],
                    // 'district' => $scheme['District'],
                    // 'block' => $scheme['Block'],
                    'panchayat' => $scheme['Panchayat'],
                    'village' => $scheme['Village'],
                    'habitation' => $scheme['Habitation'],
                ]);
            }
        });
    }
}
