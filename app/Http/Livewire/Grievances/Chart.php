<?php

namespace App\Http\Livewire\Grievances;

use App\Enums\SchemeWorkStatus;
use App\Models\Block;
use App\Models\Division;
use App\Models\Grievance;
use App\Traits\WithFinancialYear;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart extends Component
{
    use WithFinancialYear;

    public function render()
    {
        $authUserRole = auth()->user()->role;

        $grievances = Grievance::query()
            ->selectRaw("count(*) as grievances")
            ->selectRaw("count(case when status = 'pending' then 1 end) as pending")
            ->selectRaw("count(case when status = 'resolved' then 1 end) as resolved")
            ->selectRaw("count(case when status = 'unresolved' then 1 end) as unresolved")
            ->selectRaw("count(case when platform = 'call' then 1 end) as call_center")
            ->selectRaw("count(case when platform = 'app' then 1 end) as mobile_app")
            ->selectRaw("count(case when platform = 'web' then 1 end) as web")
            ->selectRaw("count(case when platform = 'whatsapp' then 1 end) as whatsapp")
            ->selectRaw("count(case when platform = 'facebook' then 1 end) as facebook")
            ->selectRaw("count(case when platform = 'QR' then 1 end) as qr_code")
            ->selectRaw("count(case when platform = 'other' then 1 end) as other")
            ->when($authUserRole == 'dpmu', fn($query) =>
                $query->where('district_id', auth()->user()->district_id)
                    ->whereRelation('scheme', 'work_status', SchemeWorkStatus::HANDED_OVER))
            ->when($authUserRole == 'panchayat', fn($query) =>
                $query->where('panchayat_id', auth()->user()->panchayat_id)
                    ->whereRelation('scheme', 'work_status', SchemeWorkStatus::HANDED_OVER))
            ->when(auth()->user()->isExecutiveEngineer(), fn($query) =>
                $query->whereIn('division_id', auth()->user()->divisions()->pluck('division_id')))
            ->when(auth()->user()->isSectionOfficer(), fn($query) =>
                $query->whereRelation('assignGrievanceTasks', 'assigned_to', auth()->id()))
            ->first();

        if ($authUserRole == 'dpmu') {
            $blockWise = Block::query()
                ->withCount(['grievances',
                    'grievances as pending' => fn($query) => $query->where('status', Grievance::STATUS_PENDING),
                    'grievances as resolved' => fn($query) => $query->where('status', Grievance::STATUS_RESOLVED),
                    'grievances as unresolved' => fn($query) => $query->where('status', Grievance::STATUS_UNRESOLVED),
                ])
                ->where('district_id', auth()->user()->district_id)
                ->orderBy('name')
                ->get();
        }

        $lineChartData = Grievance::query()
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count'),
                DB::raw("COUNT(case when status = 'pending' then 1 end) as pending"),
                DB::raw("COUNT(case when status = 'resolved' then 1 end) as resolved"),
                DB::raw("COUNT(case when status = 'unresolved' then 1 end) as unresolved"),
                DB::raw("COUNT(case when platform = 'web' then 1 end) as web"),
                DB::raw("COUNT(case when platform = 'whatsapp' then 1 end) as whatsapp"),
                DB::raw("COUNT(case when platform = 'call_center' then 1 end) as call_center"),
                DB::raw("COUNT(case when platform = 'QR' then 1 end) as QR")
            )
            ->whereBetween('created_at', [$this->financialYearStartDate(), $this->financialYearEndDate()])
            ->when($authUserRole == 'dpmu', fn($query) =>
                $query->where('district_id', auth()->user()->district_id)
                    ->whereRelation('scheme', 'work_status', SchemeWorkStatus::HANDED_OVER))
            ->when($authUserRole == 'panchayat', fn($query) =>
                $query->where('panchayat_id', auth()->user()->panchayat_id)
                    ->whereRelation('scheme', 'work_status', SchemeWorkStatus::HANDED_OVER))
            ->when(auth()->user()->isExecutiveEngineer(), fn($query) =>
                $query->whereIn('division_id', auth()->user()->divisions()->pluck('division_id')))
            ->when(auth()->user()->isSectionOfficer(), fn($query) =>
                $query->whereRelation('assignGrievanceTasks', 'assigned_to', auth()->id()))
            ->groupBy('month');

        $allGrievances = $lineChartData->pluck('count', 'month')->all();
        $pendingGrievances = $lineChartData->pluck('pending', 'month')->all();
        $resolvedGrievances = $lineChartData->pluck('resolved', 'month')->all();
        $unresolvedGrievances = $lineChartData->pluck('unresolved', 'month')->all();
        $webGrievances = $lineChartData->pluck('web', 'month')->all();
        $whatsappGrievances = $lineChartData->pluck('whatsapp', 'month')->all();
        $callCenterGrievances = $lineChartData->pluck('call_center', 'month')->all();
        $qrGrievances = $lineChartData->pluck('QR', 'month')->all();

        $matchingKeys = [];
        $pendingMatchingKeys = [];
        foreach (config('jjm.financialYearMonths') as $key => $value) {
            $matchingKeys[$value] = $allGrievances[$key] ?? 0;
            $pendingMatchingKeys[$value] = $pendingGrievances[$key] ?? 0;
            $resolvedMatchingKeys[$value] = $resolvedGrievances[$key] ?? 0;
            $unresolvedMatchingKeys[$value] = $unresolvedGrievances[$key] ?? 0;
            $webMatchingKeys[$value] = $webGrievances[$key] ?? 0;
            $whatsappMatchingKeys[$value] = $whatsappGrievances[$key] ?? 0;
            $callCenterMatchingKeys[$value] = $callCenterGrievances[$key] ?? 0;
            $qrMatchingKeys[$value] = $qrGrievances[$key] ?? 0;
        }

        $divisionsBarChartData = Division::query()
            ->withCount(['grievances', 'resolvedGrievances'])
            ->has('grievances')
            ->when(!auth()->user()->isAdministratorOrSuper(), fn($query) =>
                $query->whereIn('id', auth()->user()->divisions()->pluck('division_id')))
            ->orderBy('name');

        return view('livewire.grievances.chart', [
            'counts' => $grievances,
            'lineChartData' => $matchingKeys,
            'pendingLineChartData' => $pendingMatchingKeys,
            'resolvedLineChartData' => $resolvedMatchingKeys,
            'unresolvedLineChartData' => $unresolvedMatchingKeys,
            'webBarChartData' => $webMatchingKeys,
            'whatsappBarChartData' => $whatsappMatchingKeys,
            'callCenterBarChartData' => $callCenterMatchingKeys,
            'qrBarChartData' => $qrMatchingKeys,
            'divisionsBarChartData' => $divisionsBarChartData->pluck('grievances_count', 'name')->all(),
            'divisionsResolvedBarChartData' => $divisionsBarChartData->pluck('resolved_grievances_count', 'name')->all(),
            'blockWise' => $blockWise ?? [],
            'grievancesData' => [
                $grievances->pending,
                $grievances->resolved,
                $grievances->unresolved,
            ],
            'platformData' => [
                $grievances->call_center,
                $grievances->mobile_app,
                $grievances->web,
                $grievances->whatsapp,
                $grievances->facebook,
                $grievances->qr_code,
                $grievances->other,
            ],
            // 'issuesData' => DB::table('grievances')
            //     ->join('issues', 'grievances.issue_id', '=', 'issues.id')
            //     ->join('schemes', 'grievances.scheme_id', '=', 'schemes.id')
            //     ->join('assign_grievance_tasks', 'grievances.id', '=', 'assign_grievance_tasks.grievance_id')
            //     ->select('issues.issue', DB::raw('count(*) as count'))
            //     ->when($authUserRole == 'dpmu', fn($query) =>
            //         $query->where('grievances.district_id', auth()->user()->district_id)
            //             ->where('schemes.work_status', SchemeWorkStatus::HANDED_OVER))
            //     ->when($authUserRole == 'panchayat', fn($query) =>
            //         $query->where('grievances.panchayat_id', auth()->user()->panchayat_id)
            //             ->where('schemes.work_status', SchemeWorkStatus::HANDED_OVER))
            //     ->when(auth()->user()->isExecutiveEngineer(), fn($query) =>
            //         $query->whereIn('grievances.division_id', auth()->user()->divisions()->pluck('division_id')))
            //     ->when(auth()->user()->isSectionOfficer(), fn($query) =>
            //         $query->where('assign_grievance_tasks.assigned_to', auth()->id()))
            //     ->where('schemes.is_archived', '=', 0)
            //     ->groupBy('grievances.issue_id')
            //     ->orderBy('issues.issue')
            //     ->get()
            //     ->mapWithKeys(fn($data) => [
            //         $data->issue => $data->count,
            //     ]),
            'issuesData' => DB::table('grievances')
                ->join('issues', 'grievances.issue_id', '=', 'issues.id')
                ->join('schemes', 'grievances.scheme_id', '=', 'schemes.id')
                ->leftJoin('assign_grievance_tasks', 'grievances.id', '=', 'assign_grievance_tasks.grievance_id') // Use leftJoin if tasks might not exist
                ->select('issues.issue', DB::raw('count(grievances.id) as count')) // Count grievances explicitly
                ->when($authUserRole === 'dpmu', function ($query) {
                    return $query->where('grievances.district_id', auth()->user()->district_id)
                        ->where('schemes.work_status', SchemeWorkStatus::HANDED_OVER);
                })
                ->when($authUserRole === 'panchayat', function ($query) {
                    return $query->where('grievances.panchayat_id', auth()->user()->panchayat_id)
                        ->where('schemes.work_status', SchemeWorkStatus::HANDED_OVER);
                })
                ->when(auth()->user()->isExecutiveEngineer(), function ($query) {
                    return $query->whereIn('grievances.division_id', auth()->user()->divisions()->pluck('division_id'));
                })
                ->when(auth()->user()->isSectionOfficer(), function ($query) {
                    return $query->where('assign_grievance_tasks.assigned_to', auth()->id());
                })
                ->where('schemes.is_archived', '=', 0) // Ensure non-archived schemes
                ->groupBy('grievances.issue_id', 'issues.issue') // Group by issues.issue explicitly for clarity
                ->orderBy('issues.issue', 'asc') // Explicit order direction
                ->get()->mapWithKeys(fn($data) => [
                $data->issue => $data->count,
            ]),
        ]);
    }
}
