<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offices')->truncate();

        DB::transaction(function () {
            $offices = File::json(base_path('database/offices.json'));

            foreach ($offices as $office) {
                Office::create([
                    'name' => $office['name'],
                    'type' => $office['type'],
                ]);
            }
        });
    }
}
