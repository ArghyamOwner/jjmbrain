<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Seeder;
use App\Models\ContractorDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DummyContractorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function() {
            $zone = Zone::where('name', 'Lower Assam Zone')->first();

            $user = User::create([
                'name' => 'Contractor',
                'email' => "contractor@test.test",
                'phone' => '7099036568',
                'email_verified_at' => now(),
                'password' => bcrypt('secret'),
                'role' => 'contractor',
            ]);

            ContractorDetail::create([
                'zone_id' => $zone->id,
                'user_id' => $user->id,
                'entity_name' => 'M/S Contractor',
                'contractor_type' => 'I',
                'address' => '123 Main Street Anytown, IND',
            ]);        
        });
    }
}
