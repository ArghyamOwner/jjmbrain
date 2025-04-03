<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DivisionDashboardController extends Controller
{
    public function index()
    {
        $divisions = DB::table('divisions as d')
            ->leftJoin('schemes as s', 'd.id', '=', 's.division_id')
            ->leftJoin(DB::raw('(SELECT division_id, flowmeter_schemes FROM division_bfm_stats
                        WHERE stats_date = CURDATE() - INTERVAL 1 DAY) as bfm'),'d.id', '=', 'bfm.division_id')
            ->where('s.is_archived', '=', 0)
            ->whereNull('s.parent_id')
            ->select(
                'd.id as id',
                'd.name as name',
                DB::raw('COUNT(s.id) as total_schemes'),
                DB::raw('COUNT(CASE WHEN s.work_status = "handed-over" THEN 1 END) as handedover_schemes'),
                DB::raw('COUNT(CASE WHEN s.work_status = "completed" OR s.work_status = "handed-over" THEN 1 END) as completed_schemes'),
                DB::raw('COUNT(CASE WHEN s.work_status = "ongoing" THEN 1 END) as ongoing_schemes'),
                DB::raw('COUNT(DISTINCT s.user_id) as jalmitra_assigned'),
                DB::raw('IFNULL(bfm.flowmeter_schemes, 0) as yesterdays_bfm_stats')
            )
            ->when(!(auth()->user()->isAdministrator() || auth()->user()->isGisExpert()), function ($q) {
                $q->whereIn('d.id', auth()->user()->divisions?->pluck('id'));
            })
            ->groupBy('d.id', 'd.name', 'bfm.flowmeter_schemes')
            ->orderBy('d.name')
            ->get();

        return view('division-dashboard', [
            'divisions' => $divisions,
        ]);
    }
}
