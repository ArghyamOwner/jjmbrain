<?php

namespace Database\Seeders;

use App\Models\JalshalaSchool;
use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateJalshalaSchoolSeeder extends Seeder
{
    public function run(): void
    {
        $jalshalaSchools = JalshalaSchool::query()->whereNull('school_id')->get();

        foreach($jalshalaSchools as $jalshalaSchool){

            $schoolCode = $jalshalaSchool->school_code;

            $school = School::where('school_code', $schoolCode)->first();

            $jalshalaSchool->update([
                'school_id' => $school->id
            ]);
        }
    }
}
