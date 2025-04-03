<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlockUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $blocks = Block::get();

        $block = Block::findOrFail(12);
        // foreach ($blocks as $block) {
        $user = User::create([
            "id" => strtolower(Str::ulid()),
            "name" => $block->name . " Barpeta Block",
            "email" =>strtolower(str_replace(" ", "", $block->slug)) . "barpeta_block@jjmbrain.in",
            "email_verified_at" => now(),
            "password" => bcrypt("secret"),
            "role" => "block-user",
        ]);
        $user->blocks()->sync($block);
        // }
    }
}
