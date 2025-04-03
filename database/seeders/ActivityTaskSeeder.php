<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $activities = [
                [
                    "name" => "Deep Tube Well",
                    'slug' => 'dtw',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Barge",
                    'slug' => 'barge',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Open Well (River Source)",
                    'slug' => 'open_well',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Raw Water Pump (Submersible)",
                    'slug' => 'rwp',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Cascade Aerator",
                    'slug' => 'aerator',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "TP/Rapid Filter",
                    'slug' => 'filter',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Sedimentation Tank",
                    'slug' => 'tank',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "UGR",
                    'slug' => 'ugr',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Clear Water Pump (Centrifugal)",
                    'slug' => 'pump',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "ESR(RCC)",
                    'slug' => 'esr',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "ESR (Mild Steel + GRP)",
                    'slug' => 'esr_grp',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "ESR (Mild Steel + Zincolume)",
                    'slug' => 'esr_zinc',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "ESR (RCC + Zincolume)",
                    'slug' => 'esr_rcc',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Distibution Network (Pipeline) + FHTC",
                    'slug' => 'dnp_fhtc',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Disinfection Unit",
                    'slug' => 'disinfection',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Soil Test",
                    'slug' => 'solid_test',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "DG Set",
                    'slug' => 'dg_set',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Miscellaneous",
                    'slug' => 'misc',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Composite Structure of ESR + RSF + Aerator + Pumphouse",
                    'slug' => 'esr_rsf_aerator_pump',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Raw Water Pump + Pressure Filter",
                    'slug' => 'rwp_filter',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Boundary Wall",
                    'slug' => 'boundary_wall',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Iron Gate",
                    'slug' => 'iron_gate',
                    'type' => Activity::TYPE_TASK,
                ],
                [
                    "name" => "Support Pillar",
                    'slug' => 'support_pillar',
                    'type' => Activity::TYPE_TASK,
                ],
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
