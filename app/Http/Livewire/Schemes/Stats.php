<?php

namespace App\Http\Livewire\Schemes;

use App\Models\PanchayatPayment;
use App\Models\Scheme;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Stats extends Component
{
    public $stats = [];

    public function getStats()
    {
        $user = auth()->user();
        $stats = Scheme::query()
            ->selectRaw("count(*) as totalSchemes")
            ->selectRaw("count(case when (latitude is NOT NULL && longitude is NOT NULL) then 1 end) as latLongSchemes")
            ->selectRaw("count(case when work_status = 'handed-over' then 1 end) as handedoverSchemes")
            ->selectRaw("count(case when work_status = 'completed' OR work_status = 'handed-over' then 1 end) as completedSchemes")
            ->selectRaw("count(case when operating_status = 'non-operative' then 1 end) as nonFunctionalSchemes")
            ->selectRaw("count(case when user_id IS NOT NULL then 1 end) as jalMitra")
        // ->selectRaw("count(DISTINCT CASE WHEN canal_trackings.geojson IS NULL THEN schemes.id END) as numSchemesWithNullGeojson")
            // ->selectRaw("count(DISTINCT CASE WHEN canal_trackings.id IS NOT NULL THEN schemes.id END) as numSchemesWithCanalTracking")
            // ->selectRaw("count(DISTINCT CASE WHEN canal_trackings.geojson IS NOT NULL THEN schemes.id END) as numSchemesWithNonNullGeojson")
            // ->selectRaw("count(DISTINCT CASE WHEN canal_trackings.created_at >= CURDATE() AND canal_trackings.geojson IS NOT NULL THEN schemes.id END) as numSchemesAddedCanalTrackingToday")
            // ->selectRaw("count(DISTINCT CASE WHEN canal_trackings.created_at >= CURDATE() - INTERVAL 30 DAY  AND canal_trackings.geojson IS NOT NULL THEN schemes.id END) as numSchemesAddedCanalTrackingLast30Days")
        // ->selectRaw("count(DISTINCT CASE WHEN beneficiaries.id IS NOT NULL THEN schemes.id END) as numSchemesWithBeneficiaries")
        // ->selectRaw("count(DISTINCT CASE WHEN (schemes.imis_id IS NULL OR LENGTH(schemes.imis_id) <= 2 OR schemes.imis_id = schemes.old_scheme_id) THEN schemes.id END) as numDefaulterSchemes") // New selectRaw statement for your conditions
            // ->leftJoin('canal_trackings', 'schemes.id', '=', 'canal_trackings.scheme_id')
        // ->leftJoin('beneficiaries', 'schemes.id', '=', 'beneficiaries.scheme_id')
        // ->selectRaw("(SELECT count(*) FROM lithologs) as totalLithologs")
        // ->selectRaw("(SELECT count(*) FROM lithologs where lithologs.verification_status = 'accept') as approvedLithologs")
        // ->selectRaw("(SELECT count(*) FROM wucs) as totalWucs")
        // ->selectRaw("(SELECT COUNT(DISTINCT scheme_id) FROM lithologs) as schemesWithLitholog")
        // ->selectRaw("(SELECT COUNT(DISTINCT scheme_id) FROM lithologs where lithologs.verification_status = 'accept') as schemesWithApprovedLitholog")
            ->when(($user->isExecutiveEngineer() || $user->isTpaAdmin() || $user->isSdo()),
                fn($query) => $query->whereIn('division_id', $user->divisions()->pluck('division_id')))
            ->when($user->isSectionOfficer(), function ($query) {
                $query->whereHas('users', function ($subQuery) {
                    $subQuery->where('users.id', Auth::id());
                });
            })
            ->when($user->isPanchayat(), function ($query) {
                $query->whereHas('panchayats', function ($subQuery) {
                    $subQuery->where('panchayats.id', auth()->user()->panchayat_id);
                });
            })
            ->when($user->isPanchayatCommissioner(), function ($query) {
                $query->parent();
            })
            ->when(($user->isBlockUser() || $user->isAsrlmBlock()), function ($query) {
                $query->whereHas('blocks', function ($subQuery) {
                    $subQuery->where('blocks.id', auth()->user()->blocks()->pluck('block_id'));
                });
            })
            ->when(($user->isCeoZp()),
                fn($query) => $query->whereIn('district_id', $user->districts()->pluck('district_id')))
            ->first();

        $schemes = Scheme::query()
            ->select('id')
            ->withCount(['lithologs', 'approvedLithologs', 'wucs', 'schemePanchayatVerification'])
            ->when(($user->isExecutiveEngineer() || $user->isTpaAdmin() || $user->isSdo()),
                fn($query) => $query->whereIn('division_id', $user->divisions()->pluck('division_id')))
            ->when($user->isSectionOfficer(), function ($query) {
                $query->whereHas('users', function ($subQuery) {
                    $subQuery->where('users.id', Auth::id());
                });
            })
            ->when($user->isPanchayat(), function ($query) {
                $query->whereHas('panchayats', function ($subQuery) {
                    $subQuery->where('panchayats.id', auth()->user()->panchayat_id);
                });
            })
            ->when(($user->isBlockUser() || $user->isAsrlmBlock()), function ($query) {
                $query->whereHas('blocks', function ($subQuery) {
                    $subQuery->where('blocks.id', auth()->user()->blocks()->pluck('block_id'));
                });
            })
            ->when(($user->isCeoZp()),
                fn($query) => $query->whereIn('district_id', $user->districts()->pluck('district_id')))
            ->get();

        $this->stats = [
            // 'Number of schemes' => Str::money($totalPgAmount),
            'Total Number of schemes' => $stats->totalSchemes,
            'Number of schemes with Lat long' => $stats->latLongSchemes . ($stats->totalSchemes ? " (" . number_format((($stats->latLongSchemes / $stats->totalSchemes) * 100), 2) : "0") . " %)",
            'Number of schemes handed over' => $stats->handedoverSchemes . ($stats->totalSchemes ? " (" . number_format((($stats->handedoverSchemes / $stats->totalSchemes) * 100), 2) : "0") . " %)",
            'Number of Completed schemes' => $stats->completedSchemes,
            'Total Jal mitra' => $stats->jalMitra . ($stats->totalSchemes ? " (" . number_format((($stats->jalMitra / $stats->totalSchemes) * 100), 2) : "0") . " %)",
            'Number of Litholog created' => $schemes->sum('lithologs_count'),
            'Number of Litholog approved' => $schemes->sum('approved_lithologs_count'),
            'Total WUC created' => $schemes->sum('wucs_count'),
            // 'Tracking Started Schemes' => $stats->numSchemesWithCanalTracking,
            // 'Complete Tracked Schemes' => $stats->numSchemesWithNonNullGeojson,
            // 'Today Tracked Schemes' => $stats->numSchemesAddedCanalTrackingToday,
            // 'Tracked within 30days Schemes' => $stats->numSchemesAddedCanalTrackingLast30Days,
            // 'Schemes with FHTC Tagged' => $stats->numSchemesWithBeneficiaries,
            // 'Schemes with IMIS ID Issue' => $stats->numDefaulterSchemes,
            // 'InComplete Tracked Schemes' => $stats->numSchemesWithNullGeojson,
        ];

        if ($user->isPanchayat()) {
            $paymentAmount = PanchayatPayment::query()
                ->selectRaw(
                    'SUM(CASE WHEN amount_for = "Chemical" THEN amount_paid ELSE 0 END) as chemical,
                    SUM(CASE WHEN amount_for = "ELECTRICITY_BILL" THEN amount_paid ELSE 0 END) as electricity,
                    SUM(CASE WHEN amount_for = "JALMITRA_SALARY" THEN amount_paid ELSE 0 END) as salary,
                    SUM(CASE WHEN amount_for = "OTHER" THEN amount_paid ELSE 0 END) as other'
                )
                ->where('panchayat_id', auth()->user()->panchayat_id)
                ->first();

            $this->stats = [
                'Total Number of schemes' => $stats->totalSchemes,
                'Number of Completed schemes' => $stats->completedSchemes,
                'Number of schemes handed over' => $stats->handedoverSchemes . ($stats->totalSchemes ? " (" . number_format((($stats->handedoverSchemes / $stats->totalSchemes) * 100), 2) : "0") . " %)",
                'Schemes Verified by Panchayat' => $schemes->sum('scheme_panchayat_verification_count'),
                'Non-Functional Schemes' => $stats->nonFunctionalSchemes,
                'Total Jal-Mitra Payments' => $paymentAmount->salary ?? 0.00,
                'Total Electricity Payments' => $paymentAmount->electricity ?? 0.00,
                'Total Chemical Payments' => $paymentAmount->chemical ?? 0.00,
                'Total Other Payments' => $paymentAmount->other ?? 0.00,
            ];
        }

    }

    public function render()
    {
        return view('livewire.schemes.stats');
    }
}
