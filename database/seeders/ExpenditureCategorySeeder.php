<?php

namespace Database\Seeders;

use App\Models\ExpenditureCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenditureCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $categories = [
                "Chemical",
                'Electricity',
                'Manpower',
                'Maintenance',
            ];

            foreach ($categories as $category) {
                ExpenditureCategory::create([
                    'name' => $category,
                    'type' => 'expenditure',
                ]);
            }
        });
    }
}
