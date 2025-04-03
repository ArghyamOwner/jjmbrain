<?php

namespace App\Console\Commands;

use App\Models\Division;
use App\Models\Litholog;
use App\Models\Scheme;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateDivisionStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-division-stats';

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
        $divisions = Division::select('id', 'name')->get();
        foreach ($divisions as $division) {
            $distinctSchemesWithLithologs = DB::table('schemes as s')
                ->leftJoin('lithologs as l', 's.id', '=', 'l.scheme_id')
                ->where('s.is_archived', '=', 0)
                ->where('s.division_id', $division->id)
                ->whereNotNull('l.id')
                ->distinct()
                ->count('s.id');
            $data = DB::table('divisions as d')
                ->leftJoin('schemes as s', 'd.id', '=', 's.division_id')
                ->whereNull('s.parent_id')
                ->selectRaw("$distinctSchemesWithLithologs as lithologSchemes")
                ->selectRaw('COUNT(s.id) as totalSchemes')
                ->selectRaw('COUNT(CASE WHEN s.work_status = "completed" OR s.work_status = "handed-over" THEN 1 END) as completedSchemes')
                ->selectRaw('COUNT(CASE WHEN s.work_status = "ongoing" THEN 1 END) as ongoingSchemes')
                ->selectRaw('COUNT(CASE WHEN s.work_status = "handed-over" THEN 1 END) as handedoverSchemes')
                ->selectRaw('COUNT(CASE WHEN s.operating_status = "operative" THEN 1 END) as operativeSchemes')
                ->selectRaw('COUNT(CASE WHEN s.operating_status = "non-operative" THEN 1 END) as nonOperativeSchemes')
                ->selectRaw('COUNT(CASE WHEN s.operating_status = "partially-operative" THEN 1 END) as partiallyOperativeSchemes')
                ->selectRaw('SUM(CASE WHEN s.consumer_no IS NULL THEN 0 ELSE 1 END) as apdclConsumerNo')
                ->selectRaw('COUNT(DISTINCT s.user_id) as jalmitra')
                ->selectRaw('count(case when s.lac_id is NOT NULL then 1 end) as lacUpdated')
                ->selectRaw('count(case when s.tpi_progress is NULL then 1 end) as withoutTpiProgress')
                ->selectRaw('SUM(s.planned_fhtc) as plannedFhtc')
                ->selectRaw('SUM(s.achieved_fhtc) as achievedFhtc')
                ->selectRaw("COUNT(case when s.tpi_progress <= 30 then 1 end) as upto_30")
                ->selectRaw("COUNT(case when s.tpi_progress > 30 AND  s.tpi_progress <= 50 then 1 end) as upto_50")
                ->selectRaw("COUNT(case when s.tpi_progress > 50 AND  s.tpi_progress <= 80 then 1 end) as upto_80")
                ->selectRaw("COUNT(case when s.tpi_progress > 80 AND  s.tpi_progress <= 90 then 1 end) as upto_90")
                ->selectRaw("COUNT(case when s.tpi_progress > 90 then 1 end) as above_90")
                ->where('s.is_archived', '=', 0)
                ->where('d.id', $division->id)
                ->first();

            $dataStore = [
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Total Schemes',
                    'value' => $data->totalSchemes,
                    'division_id' => $division->id,
                    'key' => 'total_schemes',
                    'icon' => '/img/icons/water-tank.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Completed Schemes',
                    'value' => $data->completedSchemes,
                    'division_id' => $division->id,
                    'key' => 'completed_schemes',
                    'icon' => '/img/icons/competed-scheme.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Ongoing Schemes',
                    'value' => $data->ongoingSchemes,
                    'division_id' => $division->id,
                    'key' => 'ongoing_schemes',
                    'icon' => '/img/icons/work-progress.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Handedover Schemes',
                    'value' => $data->handedoverSchemes,
                    'division_id' => $division->id,
                    'key' => 'handedover_schemes',
                    'icon' => '/img/icons/handover.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Operative Schemes',
                    'value' => $data->operativeSchemes,
                    'division_id' => $division->id,
                    'key' => 'operative_schemes',
                    'icon' => '/img/icons/tap-water.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Partially-Operative Schemes',
                    'value' => $data->partiallyOperativeSchemes,
                    'division_id' => $division->id,
                    'key' => 'partially_operative_schemes',
                    'icon' => '/img/icons/water-pump.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Non-Operative Schemes',
                    'value' => $data->nonOperativeSchemes,
                    'division_id' => $division->id,
                    'key' => 'non_operative_schemes',
                    'icon' => '/img/icons/no-water.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'APDCL No. Updated',
                    'value' => $data->apdclConsumerNo,
                    'division_id' => $division->id,
                    'key' => 'apdcl_no_updated',
                    'icon' => '/img/icons/apdcl.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Jalmitra With Schemes',
                    'value' => $data->jalmitra,
                    'division_id' => $division->id,
                    'key' => 'jalmitra_with_schemes',
                    'icon' => '/img/icons/jalmitra.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Jalmitra without Scheme',
                    'value' => User::where('role', 'jal-mitra')->active()->whereRelation('divisions', 'division_id', $division->id)->doesntHave('scheme')->count(),
                    'division_id' => $division->id,
                    'key' => 'jalmitra_without_scheme',
                    'icon' => '/img/icons/jalmitra.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Geotag Schemes',
                    'value' => Scheme::whereNotNull(['latitude', 'longitude'])->whereNull('parent_id')->where('division_id', $division->id)->count(),
                    'division_id' => $division->id,
                    'key' => 'geotag_schemes',
                    'icon' => '/img/icons/geotagging.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'LAC Data Updated',
                    'value' => $data->lacUpdated,
                    'division_id' => $division->id,
                    'key' => 'lac_data_updated',
                    'icon' => '/img/icons/lac-location.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Litholog Schemes',
                    'value' => $data->lithologSchemes,
                    'division_id' => $division->id,
                    'key' => 'litholog_schemes',
                    'icon' => '/img/icons/well.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Pending Lithologs',
                    'value' => Litholog::whereRelation('scheme', 'division_id', $division->id)->where('show_diagram', 0)->count(),
                    'division_id' => $division->id,
                    'key' => 'pending_lithologs',
                    'icon' => '/img/icons/litholog-pending.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Schemes with WUC',
                    'value' => Scheme::where('division_id', $division->id)->whereNull('parent_id')->whereHas('wucs')->count(),
                    'division_id' => $division->id,
                    'key' => 'schemes_with_wuc',
                    'icon' => '/img/icons/wuc.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Planned FHTC',
                    'value' => $data->plannedFhtc,
                    'division_id' => $division->id,
                    'key' => 'planned_fhtc',
                    'icon' => '/img/icons/beneficiary.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Achieved FHTC',
                    'value' => $data->achievedFhtc,
                    'division_id' => $division->id,
                    'key' => 'achieved_fhtc',
                    'icon' => '/img/icons/checked.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'QR Installed',
                    'value' => Scheme::where('division_id', $division->id)->whereNull('parent_id')->whereHas('schemeQrReports')->count(),
                    'division_id' => $division->id,
                    'key' => 'qr_installed',
                    'icon' => '/img/icons/qr-code.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Schemes Without Workorder',
                    'value' => Scheme::where('division_id', $division->id)->whereNull('parent_id')->doesntHave('workorders')->count(),
                    'division_id' => $division->id,
                    'key' => 'schemes_without_workorder',
                    'icon' => '/img/icons/workorder-issue.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Schemes Workorder Value < 10K',
                    'value' => Scheme::where('division_id', $division->id)->whereNull('parent_id')->whereHas('workorders', function ($subQuery) {$subQuery->where('workorder_amount', '<', 100000);})->count(),
                    'division_id' => $division->id,
                    'key' => 'schemes_workorder_value_below_10k',
                    'icon' => '/img/icons/work-order-low.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Fully Tracked Schemes',
                    'value' => Scheme::where('division_id', $division->id)->whereNull('parent_id')->whereHas('canalTrackings', function ($subQuery) {$subQuery->whereNotNull('geojson');})->count(),
                    'division_id' => $division->id,
                    'key' => 'fully_tracked_schemes',
                    'icon' => '/img/icons/pipe-tracked.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'FHTC Mapped Schemes',
                    'value' => Scheme::where('division_id', $division->id)->whereNull('parent_id')->whereHas('beneficiaries')->count(),
                    'division_id' => $division->id,
                    'key' => 'fhtc_mapped_schemes',
                    'icon' => '/img/icons/fhtc-mapped.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'W/O TPI Progress',
                    'value' => $data->withoutTpiProgress,
                    'division_id' => $division->id,
                    'key' => 'without_tpi_progress',
                    'icon' => '/img/icons/without-tpi.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'TPI Upto 30%',
                    'value' => $data->upto_30,
                    'division_id' => $division->id,
                    'key' => 'tpi_upto_30',
                    'icon' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'TPI Between 30 - 50%',
                    'value' => $data->upto_50,
                    'division_id' => $division->id,
                    'key' => 'tpi_upto_50',
                    'icon' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'TPI Between 50 - 80%',
                    'value' => $data->upto_80,
                    'division_id' => $division->id,
                    'key' => 'tpi_upto_80',
                    'icon' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'TPI Between 80 - 90%',
                    'value' => $data->upto_90,
                    'division_id' => $division->id,
                    'key' => 'tpi_upto_90',
                    'icon' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'TPI Above 90%',
                    'value' => $data->above_90,
                    'division_id' => $division->id,
                    'key' => 'tpi_above_90',
                    'icon' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'IMIS ID Issue',
                    'value' => Scheme::where('division_id', $division->id)->whereNull('parent_id')->where(function ($query) {
                        $query->whereNull('imis_id')
                            ->orWhereRaw('LENGTH(imis_id) <= 2')
                            ->orWhereColumn('imis_id', 'old_scheme_id');
                    })->count(),
                    'division_id' => $division->id,
                    'key' => 'imis_id_issue',
                    'icon' => '/img/icons/imis-issue.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => strtolower((string) Str::ulid()),
                    'name' => 'Schemes Without Subdivision',
                    'value' => Scheme::where('division_id', $division->id)->whereNull('parent_id')->doesntHave('subdivisions')->count(),
                    'division_id' => $division->id,
                    'key' => 'without_subdivision',
                    'icon' => '/img/icons/data_missing.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
            DB::table('division_stats')->insert($dataStore);
        }
    }
}
