<?php

namespace Database\Seeders;

use App\Models\Scheme;
use Illuminate\Database\Seeder;

class AssignParentJmToChildSchemes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Scheme::withoutEvents(function () {
            $childSchemes = Scheme::query()
                ->with('parentScheme')
                ->whereNotNull('parent_id')
                ->get();

            foreach ($childSchemes as $scheme) {
                $scheme->update([
                    'user_id' => $scheme->parentScheme?->user_id,
                ]);
            }
        });
    }
}
