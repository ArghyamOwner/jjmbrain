<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CeoZpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = District::get();
        foreach ($districts as $district) {
            $user = User::create([
                "id" => strtolower(Str::ulid()),
                "name" => $district->name . " District",
                "email" =>
                strtolower(str_replace(" ", "", $district->slug)) . "_ceozp@jjmbrain.in",
                "email_verified_at" => now(),
                "password" => bcrypt("secret"),
                "role" => "ceo_zp",
            ]);
            $user->districts()->sync($district);
        }
    }
}
