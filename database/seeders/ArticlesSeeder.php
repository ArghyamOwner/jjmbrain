<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Article;
use Illuminate\Support\Str;
use App\Enums\HelpCategories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $faker = Factory::create();
            
            // foreach (range(1, 50) as $asset) {
                Article::create([
                    'category_id' => '01hbr9w3y22dgtbdgydmydtqkv',
                    'title' => 'Unlocking the Basics: Getting Started with JJM Brain Portal',
                    'slug' => Str::slug('Unlocking the Basics: Getting Started with JJM Brain Portal'),
                    'content' => '<p>Ornare arcu dui vivamus arcu felis bibendum ut tristique et. Diam maecenas sed enim ut sem viverra aliquet eget sit. Ut tristique et egestas quis ipsum suspendisse ultrices. Elit ullamcorper dignissim cras tincidunt lobortis feugiat vivamus at. Gravida dictum fusce ut placerat orci nulla pellentesque dignissim. Nam aliquam sem et tortor consequat id. Gravida quis blandit turpis cursus in hac habitasse platea.</p><p>Mi quis hendrerit dolor magna eget est lorem. Nulla pellentesque dignissim enim sit amet. Augue neque gravida in fermentum et sollicitudin. Tortor dignissim convallis aenean et. Quis vel eros donec ac. Tellus at urna condimentum mattis. Ac felis donec et odio pellentesque diam volutpat commodo. Fringilla est ullamcorper eget nulla facilisi etiam dignissim diam. At varius vel pharetra vel turpis nunc eget. Amet consectetur adipiscing elit pellentesque habitant morbi tristique senectus et.</p>',
                    'published_at' => now()
                ]);
            // }
        });
    }
}
