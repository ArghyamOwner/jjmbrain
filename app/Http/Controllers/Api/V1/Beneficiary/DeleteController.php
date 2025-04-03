<?php

namespace App\Http\Controllers\Api\V1\Beneficiary;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\Scheme;
use App\Models\SchemeActivity;
use App\Models\SchemeFloodInfo as SchemeFloodInfoModel;
use App\Traits\WithApiHelpers;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class DeleteController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    // $user->isJalMitra()
    public function __invoke(Beneficiary $beneficiary)
    { 
        $user = auth()->user();
        if ($user->isSectionOfficer() || $user->isContractor()) {
            if (app()->isProduction() && $beneficiary->beneficiary_photo && Storage::disk('beneficiaries')->exists($beneficiary->beneficiary_photo)) {
                Storage::disk('beneficiaries')->delete($beneficiary->beneficiary_photo);
            }
            $schemeId = $beneficiary->scheme_id;
            $name = $beneficiary->beneficiary_name;
            $phone = $beneficiary->beneficiary_phone;
            $beneficiary->delete();
            SchemeActivity::create([
                'user_id' => auth()->id(),
                'scheme_id' => $schemeId,
                'activity_type' => 'beneficiary_deleted',
                'content' => 'Beneficiary - '.$name.' ( '.($phone ?? "-").' )',
                'feedable_type' => get_class(new Scheme()),
                'feedable_id' => $schemeId
            ]);
            return $this->respondOk();
        }
        return $this->respondWithError(HttpResponse::HTTP_FORBIDDEN, 'You do not have permission to delete this beneficiary.');
        
    }
}
