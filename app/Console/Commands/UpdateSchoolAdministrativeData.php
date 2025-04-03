<?php

namespace App\Console\Commands;

use App\Models\EducationBlock;
use App\Models\School;
use Illuminate\Console\Command;

class UpdateSchoolAdministrativeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-school-administrative-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $blocks = EducationBlock::all();

        foreach ($blocks as $block) {
            School::where('education_block_id', $block->id)
                ->update(['district_id' => $block->district_id]);
        }
    }
}
