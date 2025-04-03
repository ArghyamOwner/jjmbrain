<?php

namespace Database\Seeders;

use App\Models\Scheme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::transaction(function () {
                $rabills = File::json(base_path('database/imis.json'));
               
                $count = 0;
    
                foreach ($rabills as $rabill) {    
                    $scheme = Scheme::where('old_scheme_id', $rabill['scheme_id'])->first();

                    if ($scheme) {
                        $scheme->update([
                            'imis_id' => $rabill['imisid']
                        ]);

                        $count++;
                    }
                }

                Log::info('Total: '. $count);

            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
