<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->truncate();
        
        DB::transaction(function () {
            $departments = File::json(base_path('database/departments.json'));

            foreach($departments as $department) {
                Department::create([
                    'name' => $department
                ]);
            }
        });
    }
}
