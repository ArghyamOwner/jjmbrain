<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FinancialYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        DB::table('financial_years')->truncate();

        DB::table('financial_years')->insert([
            [
                'id' => strtolower(Str::ulid()),
                'year' => 2021,
                'start_date' => "2021-04-01",
                'end_date' => "2022-03-31"
            ],
            [
                'id' => strtolower(Str::ulid()),
                'year' => 2022,
                'start_date' => "2022-04-01",
                'end_date' => "2023-03-31"
            ],
            [
                'id' => strtolower(Str::ulid()),
                'year' => 2023,
                'start_date' => "2023-04-01",
                'end_date' => "2024-03-31"
            ]
        ]);
    }
}
