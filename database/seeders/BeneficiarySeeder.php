<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Beneficiary;
use App\Models\Scheme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BeneficiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $faker = Factory::create();

            foreach (range(1, 50) as $row) {
                $scheme = Scheme::inRandomOrder()->first();
                foreach (range(1, 50) as $row) {
                    Beneficiary::create([
                        'scheme_id' => $scheme->id,
                        'beneficiary_name' => $faker->name(),
                        'beneficiary_phone' => 1234567890,
                        'beneficiary_voter_number' => "ABC1234567",
                        'beneficiary_aadhaar' => 123456789102,
                    ]);
                }
            }
        });
    }
}
