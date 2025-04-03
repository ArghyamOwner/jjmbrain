<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportIsaCoordinators extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = District::get();

        foreach ($districts as $district) {
            $user = User::create([
                'id' => strtolower(Str::ulid()),
                'name' => $district->name . ' ISA Coordinator',
                'email' => strtolower(str_replace(' ', '', $district->name)).'isacoordinator@jjmbrain.in',
                'email_verified_at' => now(),
                'password' => bcrypt('secret'),
                'role' => 'isa-coordinator',
            ]);
            $user->districts()->sync($district);
        }
    }
}
