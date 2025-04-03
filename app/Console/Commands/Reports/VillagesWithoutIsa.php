<?php

namespace App\Console\Commands\Reports;

use App\Models\Report;
use App\Models\Village;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class VillagesWithoutIsa extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:villages-without-isa';

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
        $villages = Village::query()
            ->with('district', 'panchayat.block')
            ->doesntHave('isas')
            ->lazy()
            ->sortBy('district.name');
        if ($villages->isNotEmpty()) {
            $data = $villages->map(fn($data) => [
                'district_name' => $data->district?->name,
                'block_name' => $data->panchayat?->block?->name,
                'village_name' => $data->village_name,
            ])->toArray();
            $hashedName = $this->generateAndUpload($data, 'villages_without_isa.csv', 'reports');
            $this->line($hashedName);
            $this->line('  ');
            Report::create([
                'report_number' => 'VWTISA',
                'title' => 'Villages where ISA is not assigned',
                'category' => Report::CATEGORY_VILLAGES_WITHOUT_ISA,
                'file' => $hashedName,
            ]);
        }
    }
}
