<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicDistrictDashboardController extends Controller
{
    public function index()
    {
        $schemesData = Scheme::query()
        ->whereNull('parent_id')
            ->selectRaw("
        COUNT(*) as total_schemes,
        SUM(CASE WHEN work_status = 'completed' THEN 1 ELSE 0 END) as total_completed_schemes,
        SUM(CASE WHEN work_status = 'handed-over' THEN 1 ELSE 0 END) as total_handed_over_schemes,
        SUM(CASE WHEN work_status = 'handed-over' AND operating_status = 'operative' THEN 1 ELSE 0 END) as total_functional_schemes,
        SUM(CASE WHEN work_status = 'handed-over' AND operating_status = 'partially-operative' THEN 1 ELSE 0 END) as total_partially_operative_schemes,
        SUM(CASE WHEN work_status = 'handed-over' AND operating_status = 'non-operative' THEN 1 ELSE 0 END) as total_non_operative_schemes
    ")
            ->where('is_archived', Scheme::NON_ARCHIVED)
            ->first();
        // SUM(CASE WHEN work_status = 'ongoing' THEN 1 ELSE 0 END) as total_ongoing_schemes,
        $totalSchemes = $schemesData->total_schemes;
        $totalCompletedSchemes = $schemesData->total_completed_schemes + $schemesData->total_handed_over_schemes;
        $totalOngoingSchemes = $schemesData->total_schemes - $totalCompletedSchemes;
        $totalHandedOverSchemes = $schemesData->total_handed_over_schemes;
        $totalFunctionalSchemes = $schemesData->total_functional_schemes;
        $totalPartiallyOperativeSchemes = $schemesData->total_partially_operative_schemes;
        $totalNonOperativeSchemes = $schemesData->total_non_operative_schemes;
        $schemesInfoCounts =  [
            'Total Schemes' => [
                'value' => $totalSchemes,
                'icon' => '/img/icons/water-tank.png'
            ],
            'Total Completed Schemes' => [
                'value' => $totalCompletedSchemes,
                'icon' => '/img/icons/competed-scheme.png'
            ],
            'Total Ongoing Schemes' => [
                'value' => $totalOngoingSchemes,
                'icon' => '/img/icons/work-progress.png'
            ],
            'Total Handed-over Schemes' => [
                'value' => $totalHandedOverSchemes,
                'icon' => '/img/icons/handover.png'
            ],
            'Total Functional Schemes' => [
                'value' => $totalFunctionalSchemes,
                'icon' => '/img/icons/water-tank.png'
            ],
            'Total Partially functional Schemes' => [
                'value' => $totalPartiallyOperativeSchemes,
                'icon' => '/img/icons/handover.png'
            ],
            'Total Non-functional Schemes' => [
                'value' => $totalNonOperativeSchemes,
                'icon' => '/img/icons/work-progress.png'
            ],
        ];
        $districts = DB::table('districts as d')
            ->leftJoin('schemes as s', 'd.id', '=', 's.district_id')
            ->where('s.is_archived', '=', 0)
            ->where('s.work_status', '=', 'handed-over')
            ->whereNull('s.parent_id')
            ->select(
                'd.id as id',
                'd.name as name',
                DB::raw('COUNT(CASE WHEN s.work_status = "handed-over" THEN 1 END) as work_status'),
                DB::raw('COUNT(CASE WHEN  s.operating_status = "operative" THEN 1 END) as operative_schemes'),
                DB::raw('COUNT(CASE WHEN s.operating_status = "non-operative" THEN 1 END) as non_operative_schemes'),
                DB::raw('COUNT(CASE WHEN s.operating_status = "partially-operative" THEN 1 END) as partially_operative'),
            )
            ->groupBy('d.id', 'd.name')
            ->orderBy('d.name')
            ->get();
        return view('public-district-dashboard', [
            'districts' => $districts,
            'schemesInfoCounts' => $schemesInfoCounts,
            // 'completedSchemes' => $districts->sum('completed_work_status'),
            // 'operativeSchemes' => $districts->sum('operative_schemes'),
            // 'nonOperativeSchemes' => $districts->sum('non_operative_schemes'),
            // 'partiallyOperativeSchemes' => $districts->sum('partially_operative'),
        ]);
    }
}
