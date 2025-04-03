<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrictDashboardController extends Controller
{
    public function index()
    {
        $districts = DB::table('districts as d')
            ->leftJoin('schemes as s', 'd.id', '=', 's.district_id')
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
            )
            ->when(!(auth()->user()->isAdministrator() || auth()->user()->isGisExpert()),function ($q) {
                $q->whereIn('district_id', auth()->user()->districts?->pluck('id'));
            })
            // auth()->user()->divisions()->with('districts')->get()->pluck('districts.*.id')->flatten()->unique()->all()
            ->groupBy('d.id', 'd.name')
            ->orderBy('d.name')
            ->get();

            return view('district-dashboard',[
                'districts' => $districts
            ]);
    }
}
