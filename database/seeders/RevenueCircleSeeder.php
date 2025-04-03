<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\RevenueCircle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RevenueCircleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('revenue_circles')->truncate();

        DB::transaction(function () {
            $revenueCircles = File::json(base_path('database/revenue_circle.json'));

            foreach ($revenueCircles as $circle) {
                $district = District::where('name', $circle['DISTRICTS'])->first();
                RevenueCircle::create([
                    'district_id' => $district->id,
                    'name' => $circle['REV_CIRCLE'],
                ]);
            }
        });
    }
}
