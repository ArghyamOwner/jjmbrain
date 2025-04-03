<?php

namespace App\Console\Commands\Reports;

use App\Models\Report;
use App\Models\Scheme;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class SchemesWithoutSo extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:schemes-without-so';

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
            ->with('division')
            ->doesntHave('users')
            ->orderBy('division_id')
            ->lazy();

        if ($schemes->isNotEmpty()) {
            $data = $schemes->map(fn($data) => [
                'Division' => $data->division?->name,
                'Name' => $data->name,
                'Scheme_Type' => $data->scheme_type->name,
                'IMIS-Id' => $data->imis_id,
                'SMT-Id' => $data->old_scheme_id,
            ])->toArray();
            $hashedName = $this->generateAndUpload($data, 'schemes_without_so.csv', 'reports');
            $this->line($hashedName);
            $this->line('  ');
            Report::create([
                'report_number' => 'SCWOSO',
                'title' => 'List of Schemes without Section-Officers Assigned',
                'category' => Report::CATEGORY_SCHEMES_WITHOUT_SO,
                'file' => $hashedName,
            ]);
        }
    }
}
