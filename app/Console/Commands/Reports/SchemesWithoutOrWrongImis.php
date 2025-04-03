<?php

namespace App\Console\Commands\Reports;

use App\Models\Report;
use App\Models\Scheme;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class SchemesWithoutOrWrongImis extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:schemes-without-or-wrong-imis';

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
            ->select('id', 'name', 'division_id', 'scheme_type', 'imis_id', 'old_scheme_id')
            ->with('division:id,name')
            ->whereNull('imis_id')
            ->orWhereColumn('imis_id', 'old_scheme_id')
            ->lazy();

        if ($schemes->isNotEmpty()) {
            $schemeData = $schemes->map(fn($data) => [
                'Division' => $data->division?->name,
                'Name' => $data->name,
                'Scheme_Type' => $data->scheme_type->name,
                'IMIS-ID' => $data->imis_id ?? '-',
                'SMT-ID' => $data->old_scheme_id,
            ])->toArray();
            $hashedName = $this->generateAndUpload($schemeData, 'schemes_without_imis.csv', 'reports');
            $this->line($hashedName);
            $this->line('  ');
            Report::create([
                'report_number' => 'NOIMIS',
                'title' => 'List of Schemes Without or Wrong IMIS-Id',
                'category' => Report::CATEGORY_SCHEMES_WITHOUT_OR_WRONG_IMIS,
                'file' => $hashedName,
            ]);
        }
    }
}
