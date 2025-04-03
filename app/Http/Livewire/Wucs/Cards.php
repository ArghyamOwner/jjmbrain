<?php

namespace App\Http\Livewire\Wucs;

use App\Models\Scheme;
use App\Models\Wuc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Cards extends Component
{
    public $stats = [];

    public function getStats()
    {
        $user = auth()->user();
        $wucs = Wuc::query()
            ->selectRaw("count(*) as totalWucs")
            ->selectRaw("count(case when account_number IS NULL THEN 1 end) as bankDetails")
        // ->selectRaw('COUNT(DISTINCT schemes.id) as totalSchemes')
        // ->join('scheme_wuc', 'wucs.id', '=', 'scheme_wuc.wuc_id')
        // ->join('schemes', 'scheme_wuc.scheme_id', '=', 'schemes.id')
            ->when(!($user->isAdministrator() || $user->isStateIsa() || $user->isWucAuditor()), function ($q) use ($user) {
                $q->whereIn('district_id', $user->districts->pluck('id'));
            })->first();

        $districtWucs = $user->districts->flatMap->wucs->pluck('id');

        $schemes = DB::table('scheme_wuc')
            ->select('scheme_id')
            ->when(!($user->isAdministrator() || $user->isStateIsa() || $user->isWucAuditor()), function ($q) use ($districtWucs) {
                $q->whereIn('wuc_id', $districtWucs);
            })->groupBy('scheme_id')->pluck('scheme_id');

        $schemeWithoutWuc = Scheme::query()
            ->selectRaw('COUNT(CASE WHEN work_status = "handed-over" AND (SELECT COUNT(*) FROM scheme_wuc WHERE scheme_wuc.scheme_id = schemes.id) = 0 THEN 1 END) AS handover_wo_wuc')
            ->selectRaw('COUNT(CASE WHEN (SELECT COUNT(*) FROM scheme_wuc WHERE scheme_wuc.scheme_id = schemes.id) > 1 THEN 1 END) AS multiple_wuc')
            ->when(!($user->isAdministrator() || $user->isStateIsa() || $user->isWucAuditor()), function ($q) use ($user) {
                $q->whereIn('district_id', $user->districts->pluck('id'));
            })->first();

        $villages = DB::table('scheme_village')->select('village_id')
            ->whereIn('scheme_id', $schemes)->distinct()->count();

        $this->stats = [
            [
                'title' => 'Total Number of WUCs',
                'value' => $wucs->totalWucs ?? 0,
                'link' => route('wucs'),
            ],
            [
                'title' => 'Without Bank Details',
                'value' => $wucs->bankDetails ?? 0,
                'link' => route('wucs', ['show' => 'withoutBank']),
            ],
            [
                'title' => 'Schemes Covered',
                'value' => $schemes->count() ?? 0,
                'link' => route('schemes', ['hasWuc' => 'yes']),
            ],
            [
                'title' => 'Villages Covered',
                'value' => $villages ?? 0,
                'link' => '#',
            ],
            [
                'title' => 'Handover Scheme W/O WUC',
                'value' => $schemeWithoutWuc->handover_wo_wuc,
                'link' => route('schemes', ['hasWuc' => 'no', 'status' => 'handed-over']),
            ],
            [
                'title' => 'Schemes With Multiple WUC',
                'value' => $schemeWithoutWuc->multiple_wuc,
                'link' => route('schemes', ['hasWuc' => 'multiple']),
            ],
        ];
    }

    public function render()
    {
        return view('livewire.wucs.cards');
    }
}
