<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $activities = [
                [
                    "name" => "Sluice valve",
                    'slug' => Str::slug('Sluice valve'),
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "APDCL",
                    'slug' => 'apdcl',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Rapid Sand Filter",
                    'slug' => Str::slug('Rapid Sand Filter'),
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Raw Water Pump Mains (RWPM)",
                    'slug' => Str::slug('Raw Water Pump Mains (RWPM)'),
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Pump House",
                    'slug' => Str::slug('Pump House'),
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Trail Run+WUC+HO",
                    'slug' => Str::slug('Trail Run+WUC+HO'),
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Barge (Surface Source)",
                    'slug' => Str::slug('Barge (Surface Source)'),
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Site Development",
                    'slug' => Str::slug('Site Development'),
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Staff Quarter",
                    'slug' => Str::slug('Staff Quarter'),
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Dosing Pump Silver Ionizer",
                    'slug' => Str::slug('Dosing Pump Silver Ionizer'),
                    'type' => Activity::TYPE_TASK,
                ]
            ];

            foreach ($activities as $activity) {
                Activity::create([
                    'name' => $activity['name'],
                    'slug' => $activity['slug'],
                    'type' => $activity['type'],
                ]);
            }
        });

    }
}
