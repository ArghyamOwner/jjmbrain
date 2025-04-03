<?php

namespace Database\Seeders;

use App\Models\Pattern;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $patterns = [	
                [
                    "category" => "Fine sand",
                    'number' => '30000',
                    'type' => Pattern::TYPE_LITHOLOGY
                ],
                [
                    "category" => "Fine to medium sand",
                    'number' => '33121',
                    'type' => Pattern::TYPE_LITHOLOGY
                ],
                [
                    "category" => "Medium to Coarse sand",
                    'number' => '33021',
                    'type' => Pattern::TYPE_LITHOLOGY
                ],
                [
                    "category" => "Coarse sand",
                    'number' => '30023',
                    'type' => Pattern::TYPE_LITHOLOGY
                ],
                [
                    "category" => "Clay",
                    'number' => '60000',
                    'type' => Pattern::TYPE_LITHOLOGY
                ],
                [
                    "category" => "Silt",
                    'number' => '40000',
                    'type' => Pattern::TYPE_LITHOLOGY
                ],
                [
                    "category" => "Siltstone",
                    'number' => '40000',
                    'type' => Pattern::TYPE_LITHOLOGY
                ],
                [
                    "category" => "Sandy clay",
                    'number' => '61000',
                    'type' => Pattern::TYPE_LITHOLOGY
                ],
                [
                    "category" => "Silty clay",
                    'number' => '62000',
                    'type' => Pattern::TYPE_LITHOLOGY
                ],
                [
                    "category" => "Pebbles",
                    'number' => '10000',
                    'type' => Pattern::TYPE_LITHOLOGY
                ],
                [
                    "category" => "Gravel",
                    'number' => '11030',
                    'type' => Pattern::TYPE_LITHOLOGY
                ],
                [
                    "category" => "Boulders",
                    'number' => '30400',
                    'type' => Pattern::TYPE_LITHOLOGY
                ],
                [
                    "category" => "Stainer",
                    'number' => '88000',
                    'type' => Pattern::TYPE_CASE_DIAGRAM
                ],
                [
                    "category" => "Aquifer",
                    'number' => '80000',
                    'type' => Pattern::TYPE_WATER_LEVEL
                ],
                [
                    "category" => "Static water",
                    'number' => '80100',
                    'type' => Pattern::TYPE_WATER_LEVEL
                ],
                [
                    "category" => "Casing pipe",
                    'number' => 'FFFFFF',
                    'type' => Pattern::TYPE_CASE_DIAGRAM
                ],
                [
                    "category" => "Well Cap",
                    'number' => '000000',
                    'type' => Pattern::TYPE_CASE_DIAGRAM
                ],
            ];

            foreach ($patterns as $pattern) {
                Pattern::create([
                    'category' => $pattern['category'],
                    'number' => $pattern['number'],
                    'type' => $pattern['type'],
                ]);
            }
        });
    }
}
