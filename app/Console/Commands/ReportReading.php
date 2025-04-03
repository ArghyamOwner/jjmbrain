<?php

namespace App\Console\Commands;

use App\Models\Block;
use App\Models\DocumentReport; 
use App\Models\Scheme;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ReportReading extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:report-reading';

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
        try {
            DB::transaction(function () {
                $blocks = Block::with(['district'])->get();
                $types = [DocumentReport::CATEGORY_METER_READING_WEEKLY];
                foreach ($types as $t) {
                    foreach ($blocks as $block) {
                        $this->info("Processing block: {$block->name}, type: {$t}");
                        $this->generate($t, $block->id, $block->district->id);
                    }
                }
            });
        } catch (\Exception $e) {
            $this->line($e->getMessage());
        }
    }

    protected function generate($type, $blockId, $districtID)
    {
        if ($type == DocumentReport::CATEGORY_METER_READING_WEEKLY) {
            $days = 7;
            $startDate = Date::now()->startOfWeek()->subDays($days);
            $endDate = $startDate->copy()->addDays($days - 1)->endOfDay();
            //  $this->info("last week: {$startDate}, type: {$endDate}");
        } elseif ($type == DocumentReport::CATEGORY_METER_READING_MONTHLY) {
            $startDate = Date::now()->subMonth()->startOfMonth();
            $endDate = Date::now()->startOfMonth()->subDay();
            $days = $startDate->diffInDays($endDate) + 1;
        } else {
            return;
        }
        $schemes = Scheme::query()
            ->select('id', 'name', 'old_scheme_id', 'imis_id', 'division_id', 'user_id')
            ->with([
                // 'user', 'district', 'division', 'users', 
                'division:id,name',
                'subdivisions:id,name',
                'user:id,name,phone',
                'user.latestSchemeActivity',
                'users:id,name',
                'panchayats',
                'blocks',
                'schemeDailyFlowmeter',
                // 'flowmeterDetails' => function ($query) use ($startDate, $endDate) {
                //     $query->whereBetween('created_at', [$startDate, $endDate]);
                // }
            ])->where('block_id', $blockId)
            // ->withCount(['flowmeterDetails as latest_flowmeter' => function ($query) {
            //     $query->where('created_at', '>=', now()->subDays(7));
            // }])
            ->withCount(['flowmeterDetails as latest_flowmeter' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }])
            ->withWhereHas('latestFlowmeterDetail')
            // ->withWhereHas('latestFlowmeterDetail', function ($query) {
            //     $query->with('scheme:id,name');
            // })
            ->lazy();
        $details = $schemes->map(function ($scheme) {
            // $readings = [];
            // $scheme->flowmeterDetails?->each(function ($reading) use (&$readings, $startDate, $days) {
            //     $date = $reading->created_at->startOfDay();
            //     $dayIndex = $date->diffInDays($startDate);
            //     if ($dayIndex >= 0 && $dayIndex < $days) {
            //         $readings[$dayIndex] = (int)$reading->value;
            //     }
            // });
            // $so_details = $scheme->users?->map(function ($so) {
            //     return [
            //         'so_name' => $so->name,
            //         'so_phone' => $so->phone,
            //     ];
            // });
            // smt id - old_scheme_id, Division, District , 
            // Block, jalmitra phone, and name, daily_flow_meter reporting 
            return [
                // 'SMT ID' => $scheme->old_scheme_id,
                // 'IMIS' => $scheme->imis_id,
                // 'Division' => $scheme->division?->name,
                // 'District' => $scheme->district?->name,
                // 'jm_name' => $scheme->user?->name,
                // 'jm_phone' => $scheme->user?->phone,
                // 'reading' => $readings,
                // 'so_details' => $so_details,
                // 'Flow meter reporting' => count($readings),
                // 'Scheme name' => $scheme->name,
                'Division' => $scheme->division?->name,
                'Subdivision' => $scheme->subdivision_names,
                'Block(s)' => $scheme->block_names_csv,
                'GP(s)' => $scheme->panchayat_names_csv,
                'Villages' => $scheme->villages_names_csv,
                'Scheme name' => str_replace(',', '-', $scheme->name),
                'imis_id' => $scheme->imis_id,
                'SMT_id' => $scheme->old_scheme_id,
                'jalmitra_name' => $scheme->user?->name,
                'jalmitra_phone' => $scheme->user?->phone,
                'Section-Officers phone' => $scheme->so_phones,
                'section-officers' => $scheme->so_names,
                'latest_activity_at' => $scheme->user?->latestSchemeActivity?->created_at?->format('d-m-Y'),
                'latest_meter_reading' => $scheme->latestFlowmeterDetail?->value,
                'Latest Bulk flow meter working Status' => $scheme->schemeDailyFlowmeter?->status,
                'Latest Meter Reading Date' => $scheme->latestFlowmeterDetail?->created_at?->format('d-m-Y'),
                'Flow Meter Reporting' => $scheme->latest_flowmeter,
            ];
        });
        $data = $details->toArray();
        if ($data) {
            $hashedName = $this->generateAndUpload($data, "meter_reading_{$type}_{$startDate->format('Y-m-d')}_to_{$endDate->format('Y-m-d')}.csv", 'reports');
            $this->line($hashedName);
            $this->line('  ');
            $divisionIds = $schemes->pluck('division.id')->unique();
            $this->line("Division ID: {$divisionIds}");
            $divisionId = $divisionIds->count() === 1 ? $divisionIds->first() : null;
            DocumentReport::create([
                'report_number' => 'MTREAD',
                'title' => "Meter Reading Report",
                'category' => $type,
                'file' => $hashedName,
                'block_id' => $blockId,
                'division_id' => $divisionId,
                'district_id' => $districtID,
            ]);
        } else {
            $this->line("No data Found");
        }
    }
}
