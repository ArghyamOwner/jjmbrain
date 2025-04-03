<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AsrlmBlockUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blocks = Block::get();

        foreach ($blocks as $block) {
            $user = User::create([
                'id' => strtolower(Str::ulid()),
                'name' => $block->name . ' Block',
                'email' => strtolower(str_replace(' ', '', $block->slug)) . '_asrlm@jjmbrain.in',
                'email_verified_at' => now(),
                'password' => bcrypt('secret'),
                'role' => 'asrlm-block',
            ]);
            $user->blocks()->sync($block);
        }
    }
}
