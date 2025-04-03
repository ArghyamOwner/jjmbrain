<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;

class ReportsController extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function index()
    {
        if (auth()->user()->isStateJaldootCell()) {
            return view('reports-state-jaldoot-cell');
        }
        if (auth()->user()->isExecutiveEngineer()) {
            return view('reports-executive-engineer');
        }
        if (auth()->user()->isSectionOfficer()) {
            return view('reports-section-officer');
        }
        if (auth()->user()->isSdo()) {
            return view('reports-sdo');
        }
        if (auth()->user()->isGeologyHo()) {
            return view('reports-geology-ho');
        }
        if (auth()->user()->isIsaCoordinator()) {
            return view('reports-isa-coordinator');
        }
        if (auth()->user()->isStateIsa()) {
            return view('state-isa-reports');
        }
        if (auth()->user()->isAsrlmBlock()) {
            return view('reports-asrlm-block');
        }
        if (auth()->user()->isHeadOffice()) {
            return view('reports-head-office');
        }
        if (auth()->user()->isAddChiefEngineer()) {
            return view('reports-add-chief-engineer');
        }
        if (auth()->user()->isSuperintendentEngineer()) {
            return view('reports-superintendent_engineer');
        }
        if (auth()->user()->isGisExpert()) {
            return view('reports-gis-expert');
        }
        if (auth()->user()->isDc()) {
            return view('reports-dc');
        }
        if (auth()->user()->isWucAuditor()) {
            return view('wuc-auditor-reports');
        }
        if (auth()->user()->isDistrictJaldootCell()) {
            return view('reports-district-jaldoot-cell');
        }
        return view('reports');
    }

    public function generate(Division $division)
    {
        $schemeLazyCollection = Scheme::query()
            ->with(
                'district:id,name',
                'blocks',
                'lac:id,name',
                'user:id,name,doj'
            )->withExists(['lithologs', 'workorders'])
            ->where('division_id', $division->id)
            ->lazy();

        if ($schemeLazyCollection->isNotEmpty()) {
            $schemes = $schemeLazyCollection->map(fn($data) => [
                'name' => $data->name,
                'SMT_id' => $data->old_scheme_id,
                'imis_id' => $data->imis_id,
                'scheme_type' => $data->scheme_type?->name,
                'division' => $division->name,
                'district' => $data->district?->name,
                'block' => $data->block_names,
                'work_status' => $data->work_status?->name,
                'operating_status' => $data->operating_status?->name,
                'scheme_status' => $data->scheme_status?->name,
                'villages' => $data->village_names,
                'lac' => $data->lac?->name,
                'approved_on' => $data->approved_on,
                'slssc_year' => $data->slssc_year,
                'planned_fhtc' => $data->planned_fhtc,
                'achieved_fhtc' => $data->achieved_fhtc ?? '-',
                'section-officers' => $data->so_names,
                'jalmitra_name' => $data->user?->name,
                'jalmitra_doj' => $data->user?->doj?->format('Y-m-d'),
                'handover_date' => $data->handover_date?->format('Y-m-d'),
                'state_share' => $data->state_share,
                'central_share' => $data->central_share,
                'total_cost' => $data->total_cost,
                'consumer_no' => $data->consumer_no,
                'latitude' => $data->latitude,
                'longitude' => $data->longitude,
                'has_litholog' => $data->lithologs_exists ? 'Yes' : 'No',
                'has_workorder' => $data->workorders_exists ? 'Yes' : 'No',
                'Verification_status' => $data->verified_on ? 'Yes' : 'No',
            ])->toArray();

            return $this->exportToCsv($schemes, $division->name . '_schemes.csv');
        } else {
            $this->banner('Data not found');
            return redirect()->back();
        }
    }
}
