<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Seeder;

class AddDistrictToVillagesTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $villages = Village::query()
            ->with('panchayat.block')
            ->get();
        foreach ($villages as $village) {
            $village->update([
                'district_id' => $village?->panchayat?->block?->district_id,
            ]);
        }
    }
}
