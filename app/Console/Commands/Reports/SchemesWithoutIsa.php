<?php

namespace App\Console\Commands\Reports;

use App\Models\Report;
use App\Models\Scheme;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class SchemesWithoutIsa extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:schemes-without-isa';

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
        $schemes = Scheme::query()
            ->with('district', 'division', 'villages')
            ->whereHas("wucs", function ($q) {
                $q->doesntHave("isas");
            })
            ->get()
            ->sortBy('district.name');
        if ($schemes->isNotEmpty()) {
            $data = $schemes->map(fn($data) => [
                'district' => $data->district?->name,
                'division' => $data->division?->name,
                'village_name' => $data->villages?->pluck('village_name')->join(','),
                'scheme_name' => $data->name,
                'imis_id' => $data->imis_id,
                'smt' => $data->old_scheme_id,
            ])->toArray();
            $hashedName = $this->generateAndUpload($data, 'schemes_without_isa.csv', 'reports');
            $this->line($hashedName);
            $this->line('  ');
            Report::create([
                'report_number' => 'SWUCWI',
                'title' => 'Schemes having WUC without ISA',
                'category' => Report::CATEGORY_SCHEMES_WITHOUT_ISA,
                'file' => $hashedName,
            ]);
        }
    }
}
