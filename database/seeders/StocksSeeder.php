<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Lab;
use App\Models\Item;
use App\Models\Stock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            foreach (range(1, 50) as $row) {
                $date = Carbon::create(2023, 4, 28);

                $item = Item::inRandomOrder()->first();
                $lab = Lab::inRandomOrder()->first();
    
                Stock::create([
                    'item_id' => $item->id,
                    'lab_id' => $lab->id,
                    'manufacturing_date' => $date->format('Y-m-d'),
                    'expiry_date' => $date->addWeeks(rand(1, 52))->format('Y-m-d'),
                    'quantity' => mt_rand(10, 500),
                    'stock_flow' => 'procurement',
                ]);
            }
        });
    }
}
