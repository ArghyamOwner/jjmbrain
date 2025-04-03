<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->truncate();
        
        DB::transaction(function () {
            $items = File::json(base_path('database/items.json'));

            foreach($items as $item) {
                Item::create([
                    'category' => $item['category'],
                    'type' => $item['type'],
                    'item_name' => $item['item_name'],
                    'item_code' => $item['item_code'],
                    'nature_of_use' => $item['nature_of_use'],
                    'hazard_level' => $item['hazard_level'],
                    'unit' => $item['unit'],
                ]);
            }
        });
    }
}
