<?php

namespace Database\Seeders;

use App\Models\Circle;
use App\Models\Lab;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LabsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('labs')->truncate();
        
        DB::transaction(function () {
            $labs = File::json(base_path('database/labs.json'));

            foreach($labs as $lab) {
                $circle = Circle::inRandomOrder()->first();
                
                Lab::create([
                    'circle_id' => $circle->id,
                    'lab_name' => $lab['lab_name'],
                    'contact_person' => $lab['contact_person'],
                    'phone' => $lab['phone'],
                    'nabl_certification' => $lab['nabl_certification'],
                ]);
            }
        });
    }
}
