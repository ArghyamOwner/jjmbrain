<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $activities = [
                [
                    "name" => "Gram Sabha",
                    'slug' => 'gram'
                ],
                [
                    "name" => "Cluster Level Meetings",
                    'slug' => 'cluster'
                ],
                [
                    "name" => "Community Level Meetings",
                    'slug' => 'community'
                ],
                [
                    "name" => "VWSC Formation",
                    'slug' => 'vwsc'
                ],
                [
                    "name" => "Women Committee Meeting for FTK Group Selection",
                    'slug' => 'wcm'
                ],
                [
                    "name" => "User's Committee",
                    'slug' => 'user'
                ],
                [
                    "name" => "Open Miking",
                    'slug' => 'miking'
                ],
                [
                    "name" => "PRA",
                    'slug' => 'pra'
                ],
                [
                    "name" => "VAP",
                    'slug' => 'vap'
                ],
                [
                    "name" => "FGD",
                    'slug' => 'fgd'
                ],
                [
                    "name" => "Concent Letter",
                    'slug' => 'letter'
                ],
                [
                    "name" => "VWSC Status",
                    'slug' => 'vwsc_status'
                ],
            ];

            foreach ($activities as $activity) {
                Activity::create([
                    'name' => $activity['name'],
                    'slug' => $activity['slug'],
                ]);
            }
        });
    }
}
