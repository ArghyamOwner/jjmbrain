<?php

namespace App\Http\Controllers;

use App\Enums\SchemeWorkStatus;
use App\Models\IotDevice;
use App\Models\Scheme;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SchemeShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Scheme $scheme, $tab = 'details')
    {
        $user = auth()->user();
        $tabViewName = match ($tab) {
            'details' => 'schemes.basic-details',
            'images' => 'schemes.images',
            // 'videos' => 'schemes.videos',
            'assets' => 'schemes.assets',
            // 'map' => 'schemes.map',
            'so-user' => 'schemes.so-user',
            'activity' => 'schemes.activity',
            'workorders' => 'schemes.workorders',
            'beneficiary' => 'schemes.beneficiary',
            'jalmitra-user' => 'schemes.jalmitra-user',
            'lithologs' => 'schemes.lithologs',
            'wuc' => 'schemes.wuc',
            'pipe-network' => 'schemes.pipe-network-index',
            'archive-requests' => 'schemes.archive-requests',
            'flood-info-scheme' => 'schemes.flood-info-scheme',
            'flow-meter-index' => 'schemes.flowmeter-index',
            'esr-complaints' => 'schemes.esr-complaints',
            default => 'schemes.basic-details'
        };

        $scheme->loadMissing([
            'division.circle',
            'district',
            'villages',
            'panchayats',
            'blocks',
            'ratings',
            'parentScheme',
            'verifiedBy:id,name',
            'schemeQrReports:id,scheme_id',
            'schemePanchayatVerification',
            'schemeBinaryData',
        ])->loadCount('villages');

        $schemeUrl = route('schemes.qrcodeDetails', $scheme->id);

        if ($scheme->villages_count > 1) {
            $count = 'Multiple Village';
        } else {
            $count = 'Single Village';
        }

        $showHandOverVerification = false;
        if ((!$scheme->schemePanchayatVerification?->verified_by) && $user->isPanchayat() && ($scheme->work_status === SchemeWorkStatus::HANDED_OVER)) {
            $showHandOverVerification = true;
        }

        $showSchemeVerification = false;
        $quickActionsDoNotShowToPanchayatUser = true;
        if ($user->isPanchayat() || $user->isBlockUser() || $user->isCeoZp() || $user->isPanchayatCommissioner()) {
            $showSchemeVerification = true;
            $quickActionsDoNotShowToPanchayatUser = false;
        }

        $showFetchSmtWorkorderDetailsButton = false;
        if (($user->isAdministrator() || $user->isExecutiveEngineer() || $user->isSuperintendentEngineer()) && $scheme->old_scheme_id) {
            $showFetchSmtWorkorderDetailsButton = true;
        }

        $showArchiveButton = false;
        if ($user->isAdministrator()) {
            $showArchiveButton = true;
        }

        $showArchiveRequestButton = false;
        if ($user->isSectionOfficer() || $user->isExecutiveEngineer() || $user->isAdministrator() || $user->isSdo()) {
            $showArchiveRequestButton = true;
        }
        $showIotDetailsButton = false;
        $iotDevice = null;
        if ($user->isAdministrator()) {
            try {
                $iotDevice = IotDevice::where('scheme_id', $scheme->id)->firstOrFail();
            } catch (\Exception $e) {
                $iotDevice = null;
            }
            if ($iotDevice) {
                $showIotDetailsButton = true;
            }
        }
        // $scheme->handover_date
        $handedOverColor = null;
        $handedOverToolTip = null;
        $handedOverPercentage = 0.0;
        $dlpDaysLeft = null;
        if ($scheme->handover_date) {
            $handoverDate = Carbon::parse($scheme->handover_date);
            $currentDate = Carbon::now();
            $monthsDifference = $handoverDate->diffInMonths($currentDate);
            if ($monthsDifference <= 6) {
                $handedOverColor = 'green';
                $handedOverToolTip = 'DLP 6 months completed';
            } elseif ($monthsDifference >= 7 && $monthsDifference <= 10) {
                $handedOverColor = 'orange';
                $handedOverToolTip = 'DLP 7th to 10th months completed';
            } elseif ($monthsDifference >= 11 && $monthsDifference <= 12) {
                $handedOverColor = 'red';
                $handedOverToolTip = 'DLP 11th to 12th months completed';
            } else {
                $handedOverColor = 'purple';
                $handedOverToolTip = 'DLP period completed';
            }
            // get percentage //
            $daysDifference = $handoverDate->diffInDays($currentDate);
            // is time over 
            if ($daysDifference >= 365) {
                $handedOverPercentage = 100;
                $dlpDaysLeft = 0;
            } else {
                $handedOverPercentage = ($daysDifference / 365) * 100;
                $dlpDaysLeft = 365 - $daysDifference;
            }
        }
        // 
        return view('schemes.show', [
            'scheme' => $scheme,
            'tabViewName' => $tabViewName,
            'schemeQrcode' => QrCode::size(110)->generate($schemeUrl),
            'schemeQrcodeLarge' => QrCode::size(140)->generate($schemeUrl),
            'latitude' => $scheme->latitude,
            'longitude' => $scheme->longitude,
            'schemeRating' => round($scheme->ratings?->avg('rating'), 2),
            'review' => count($scheme->ratings),
            'villageCount' => $count,
            'showArchiveButton' => $showArchiveButton,
            'showArchiveRequestButton' => $showArchiveRequestButton,
            'showHandOverVerification' => $showHandOverVerification,
            'showSchemeVerification' => $showSchemeVerification,
            'quickActionsDoNotShowToPanchayatUser' => $quickActionsDoNotShowToPanchayatUser,
            'showFetchSmtWorkorderDetailsButton' => $showFetchSmtWorkorderDetailsButton,
            'showIotDetailsButton' => $showIotDetailsButton,
            'iotDevice' => $iotDevice,
            'handedOverColor' => $handedOverColor,
            'handedOverPercentage' => round($handedOverPercentage),
            'dlpDaysLeft' => $dlpDaysLeft,
            'handedOverToolTip' => $handedOverToolTip,
        ]);
    }
}
