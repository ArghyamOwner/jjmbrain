<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Asset;
use App\Models\Circle;
use App\Enums\AssetType;
use Illuminate\Support\Str;
use App\Enums\AssetCategory;
use App\Models\FinancialYear;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $faker = Factory::create();

            $assets = [
                [
                    "name" => "Motor Pump",
                    "manufacturer" => "ABC Company",
                    "serialNumber" => "SN001"
                ],
                [
                    "name" => "Barge",
                    "manufacturer" => "XYZ Company",
                    "serialNumber" => "SN002"
                ],
                [
                    "name" => "Transformer",
                    "manufacturer" => "DEF Company",
                    "serialNumber" => "SN003"
                ],
                [
                    "name" => "Overhead Tank",
                    "manufacturer" => "GHI Company",
                    "serialNumber" => "SN004"
                ],
                [
                    "name" => "Control Panel",
                    "manufacturer" => "JKL Company",
                    "serialNumber" => "SN005"
                ]
            ];

            $financialYear = FinancialYear::where('year', 2023)->first();
            $circle = Circle::inRandomOrder()->first();

            foreach ($assets as $asset) {
                Asset::create([
                    'circle_id' => $circle->id,
                    'financial_year_id' => $financialYear->id,
                    'asset_uin' => Str::random(10),
                    'asset_type' => $faker->randomElement(AssetType::values()),
                    'asset_category' => $faker->randomElement(AssetCategory::values()),
                    'item_name' => $asset['name'],
                    'serial_number' => $asset['serialNumber'],
                    'manufacturer' => $asset['manufacturer'],
                ]);
            }
        });
    }
}
