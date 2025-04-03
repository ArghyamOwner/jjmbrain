<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Workorder;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\WithApiHelpers;

class WorkordersOtpController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Workorder $workorder, Request $request)
    {
        $workorder->load('contractor');
         
        if ($workorder->contractor && is_null($workorder->contractor->phone)) {
            return $this->respondWithUnprocessableEntity('No Phone Number Associated');
        }

        if ($workorder->contractor && !is_null($workorder->contractor->otp)) {
            SmsService::make('63e08c1dd6fc05595276b3b2')
                ->to($workorder->contractor->phone)
                ->addVariables([
                    'number' => $workorder->contractor->otp
                ])->send();
        } else {

            $otp = mt_rand(111111, 999999);

            $workorder->contractor->update(['otp' => $otp]);

            SmsService::make('63e08c1dd6fc05595276b3b2')
                ->to($workorder->contractor->phone)
                ->addVariables([
                    'number' => $workorder->contractor->otp
                ])->send();
        }

        return $this->respondCreated();
    }
}