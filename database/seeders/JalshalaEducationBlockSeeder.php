<?php

namespace Database\Seeders;

use App\Models\Jalshala;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JalshalaEducationBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jalshalas = Jalshala::get();

        foreach($jalshalas as $jalshala){
            $jalshala->educationBlocks()->sync($jalshala->education_block_id);
        }
    }
}
