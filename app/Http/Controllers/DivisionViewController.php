<?php

namespace App\Http\Controllers;

use App\Models\Division;

class DivisionViewController extends Controller
{
    public function index(Division $division)
    {
        // $distinctSchemesWithLithologs = DB::table('schemes as s')
        //     ->leftJoin('lithologs as l', 's.id', '=', 'l.scheme_id')
        //     ->where('s.is_archived', '=', 0)
        //     ->where('s.division_id', $division->id)
        //     ->whereNotNull('l.id')
        //     ->distinct()
        //     ->count('s.id');

        // $data = DB::table('divisions as d')
        //     ->leftJoin('schemes as s', 'd.id', '=', 's.division_id')
        // // ->leftJoin('lithologs as l', 's.id', '=', 'l.scheme_id')
        // // ->leftJoin('scheme_qr_reports as qr', 's.id', '=', 'qr.scheme_id') // Join with scheme_qr_reports
        // // ->leftJoin('canal_trackings as ct', 's.id', '=', 'ct.scheme_id') // Join with scheme_qr_reports
        //     ->selectRaw("$distinctSchemesWithLithologs as lithologSchemes")
        //     ->selectRaw('COUNT(s.id) as totalSchemes')
        // // ->selectRaw('COUNT(CASE WHEN l.show_diagram = 0 THEN 1 END) as pendingLithologs')
        //     ->selectRaw('COUNT(CASE WHEN s.work_status = "completed" THEN 1 END) as completedSchemes')
        //     ->selectRaw('COUNT(CASE WHEN s.work_status = "ongoing" THEN 1 END) as ongoingSchemes')
        //     ->selectRaw('COUNT(CASE WHEN s.work_status = "handed-over" THEN 1 END) as handedoverSchemes')
        //     ->selectRaw('COUNT(CASE WHEN s.operating_status = "operative" THEN 1 END) as operativeSchemes')
        //     ->selectRaw('COUNT(CASE WHEN s.operating_status = "non-operative" THEN 1 END) as nonOperativeSchemes')
        //     ->selectRaw('COUNT(CASE WHEN s.operating_status = "partially-operative" THEN 1 END) as partiallyOperativeSchemes')
        //     ->selectRaw('SUM(CASE WHEN s.consumer_no IS NULL THEN 0 ELSE 1 END) as apdclConsumerNo')
        //     ->selectRaw('COUNT(DISTINCT s.user_id) as jalmitra')
        // // ->selectRaw('count(case when s.latitude is NOT NULL then 1 end) as latLongSchemes')
        //     ->selectRaw('count(case when s.lac_id is NOT NULL then 1 end) as lacUpdated')
        //     ->selectRaw('SUM(s.planned_fhtc) as plannedFhtc')
        //     ->selectRaw('SUM(s.achieved_fhtc) as achievedFhtc')
        // // ->selectRaw('COUNT(DISTINCT qr.id) as total_qr_installed') // Count of total QR installed
        // // ->selectRaw('COUNT(DISTINCT ct.scheme_id) as total_tracked') // Count of total QR installed
        //     ->where('s.is_archived', '=', 0)
        //     ->where('d.id', $division->id)
        //     ->first();

        // $divData = [
        //     [
        //         'title' => 'Total Schemes',
        //         'value' => $data->totalSchemes,
        //         'link' => route('schemes', ['division' => $division->id]),
        //         'icon' => '/img/icons/water-tank.png',
        //     ],
        //     [
        //         'title' => 'Completed Schemes',
        //         'value' => $data->completedSchemes,
        //         'link' => route('schemes', ['division' => $division->id, 'status' => SchemeWorkStatus::COMPLETED]),
        //         'icon' => '/img/icons/competed-scheme.png',
        //     ],
        //     [
        //         'title' => 'Ongoing Schemes',
        //         'value' => $data->ongoingSchemes,
        //         'link' => route('schemes', ['division' => $division->id, 'status' => SchemeWorkStatus::ONGOING]),
        //         'icon' => '/img/icons/work-progress.png',
        //     ],
        //     [
        //         'title' => 'Handedover Schemes',
        //         'value' => $data->handedoverSchemes,
        //         'link' => route('schemes', ['division' => $division->id, 'status' => SchemeWorkStatus::HANDED_OVER]),
        //         'icon' => '/img/icons/handover.png',
        //     ],
        //     [
        //         'title' => 'Operative Schemes',
        //         'value' => $data->operativeSchemes,
        //         'link' => route('schemes', ['division' => $division->id, 'operating_status' => SchemeOperatingStatus::OPERATIVE]),
        //         'icon' => '/img/icons/tap-water.png',
        //     ],
        //     [
        //         'title' => 'Partially-Operative Schemes',
        //         'value' => $data->partiallyOperativeSchemes,
        //         'link' => route('schemes', ['division' => $division->id, 'operating_status' => SchemeOperatingStatus::PARTIALLY_OPERATIVE]),
        //         'icon' => '/img/icons/water-pump.png',
        //     ],
        //     [
        //         'title' => 'Non-Operative Schemes',
        //         'value' => $data->nonOperativeSchemes,
        //         'link' => route('schemes', ['division' => $division->id, 'operating_status' => SchemeOperatingStatus::NON_OPERATIVE]),
        //         'icon' => '/img/icons/no-water.png',
        //     ],
        //     [
        //         'title' => 'APDCL No. Updated',
        //         'value' => $data->apdclConsumerNo,
        //         'link' => route('schemes', ['division' => $division->id, 'hasConsumerNo' => true]),
        //         'icon' => '/img/icons/apdcl.png',
        //     ],
        //     [
        //         'title' => 'Jalmitra With Schemes',
        //         'value' => $data->jalmitra,
        //         'link' => route('jm.users', ['division' => $division->id, 'hasScheme' => 'yes']),
        //         'icon' => '/img/icons/jalmitra.png',
        //     ],
        //     [
        //         'title' => 'Jalmitra without Scheme',
        //         'value' => User::where('role', 'jal-mitra')->whereRelation('divisions', 'division_id', $division->id)->doesntHave('scheme')->count(),
        //         'link' => route('jm.users', ['division' => $division->id, 'hasScheme' => 'no']),
        //         'icon' => '/img/icons/jalmitra.png',
        //     ],
        //     [
        //         'title' => 'Geotag Schemes',
        //         'value' => Scheme::whereNotNull(['latitude', 'longitude'])->where('division_id', $division->id)->count(),
        //         'link' => route('schemes', ['division' => $division->id, 'hasLocation' => 'with']),
        //         'icon' => '/img/icons/geotagging.png',
        //     ],
        //     [
        //         'title' => 'LAC Data Updated',
        //         'value' => $data->lacUpdated,
        //         'link' => route('schemes', ['division' => $division->id, 'hasLac' => true]),
        //         'icon' => '/img/icons/lac-location.png',
        //     ],
        //     [
        //         'title' => 'Litholog Schemes',
        //         'value' => $data->lithologSchemes,
        //         'link' => route('schemes', ['division' => $division->id, 'has_litholog' => true]),
        //         'icon' => '/img/icons/well.png',
        //     ],
        //     [
        //         'title' => 'Pending Lithologs',
        //         'value' => Litholog::whereRelation('scheme', 'division_id', $division->id)->where('show_diagram', 0)->count(),
        //         'link' => route('lithologs', ['division' => $division->id, 'type' => 'pending']),
        //         'icon' => '/img/icons/litholog-pending.png',
        //     ],
        //     [
        //         'title' => 'Schemes with WUC',
        //         'value' => Scheme::where('division_id', $division->id)->whereHas('wucs')->count(),
        //         'link' => route('schemes', ['division' => $division->id, 'hasWuc' => 'yes']),
        //         'icon' => '/img/icons/wuc.png',
        //     ],
        //     [
        //         'title' => 'Planned FHTC',
        //         'value' => $data->plannedFhtc,
        //         'link' => '#',
        //         'icon' => '/img/icons/beneficiary.png',
        //     ],
        //     [
        //         'title' => 'Achieved FHTC',
        //         'value' => $data->achievedFhtc,
        //         'link' => '#',
        //         'icon' => '/img/icons/checked.png',
        //     ],
        //     [
        //         'title' => 'QR Installed',
        //         'value' => Scheme::where('division_id', $division->id)->whereHas('schemeQrReports')->count(),
        //         'link' => route('schemes', ['division' => $division->id, 'qrInstalled' => 'yes']),
        //         'icon' => '/img/icons/qr-code.png',
        //     ],
        //     [
        //         'title' => 'Schemes Without Workorder',
        //         'value' => Scheme::where('division_id', $division->id)->doesntHave('workorders')->count(),
        //         'link' => route('schemes', ['division' => $division->id, 'workorders' => 'no']),
        //         'icon' => '/img/icons/workorder-issue.png',
        //     ],
        //     [
        //         'title' => 'Schemes Workorder Value < 10K',
        //         'value' => Scheme::where('division_id', $division->id)->whereHas('workorders', function ($subQuery) {$subQuery->where('workorder_amount', '<', 100000);})->count(),
        //         'link' => route('schemes', ['division' => $division->id, 'woValueBelow10k' => true]),
        //         'icon' => '/img/icons/work-order-low.png',
        //     ],
        //     [
        //         'title' => 'Fully Tracked Schemes',
        //         'value' => Scheme::where('division_id', $division->id)->whereHas('canalTrackings', function ($subQuery) {$subQuery->whereNotNull('geojson');})->count(),
        //         'link' => route('schemes', ['division' => $division->id, 'tracking' => 'yes']),
        //         'icon' => '/img/icons/pipe-tracked.png',
        //     ],
        //     [
        //         'title' => 'FHTC Mapped Schemes',
        //         'value' => Scheme::where('division_id', $division->id)->whereHas('beneficiaries')->count(),
        //         'link' => route('schemes', ['division' => $division->id, 'fhtc' => 'yes']),
        //         'icon' => '/img/icons/fhtc-mapped.png',
        //     ],
        //     [
        //         'title' => 'IMIS ID Issue',
        //         'value' => Scheme::where('division_id', $division->id)->where(function ($query) {
        //                 $query->whereNull('imis_id')
        //                     ->orWhereRaw('LENGTH(imis_id) <= 2')
        //                     ->orWhereColumn('imis_id', 'old_scheme_id');
        //             })->count(),
        //         'link' => route('schemes', ['division' => $division->id, 'imisIssue' => 'yes']),
        //         'icon' => '/img/icons/imis-issue.png',
        //     ],
        // ];

        return view('division-view', [
            // 'divData' => $divData,
            'division' => $division,
        ]);
    }
}
