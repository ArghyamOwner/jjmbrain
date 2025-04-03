<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleCategory::create([
            'name' => 'Getting Started',
            'slug' => Str::slug('Getting Started'),
            'icon' => 'setting',
            'order' => 1,
            'description' => 'Everything you need to know to get started and get to work in this portal.'
        ]);

        ArticleCategory::create([
            'name' => 'User Account',
            'slug' => Str::slug('User Account'),
            'icon' => 'users',
            'order' => 2,
            'description' => 'How to reset password, change password, and so on.'
        ]);

        ArticleCategory::create([
            'name' => 'Uncategorized',
            'slug' => Str::slug('Uncategorized'),
            'icon' => 'folder',
            'order' => 3,
            'description' => 'All miscellaneous informations of the portal.'
        ]);
    }
}
