<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Workorder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\WithApiHelpers;

class WorkordersOtpVerifyController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Workorder $workorder, Request $request)
    {
        $workorder->load('contractor');
        
        $validated = $request->validate([
            'otp' => ['required']
        ]);
         
        if ($workorder->contractor && $workorder->contractor->otp == $validated['otp']) {
            $workorder->contractor->update(['otp' => null]);
            return $this->respondCreated();
        } else {
            return $this->respondWithUnprocessableEntity('OTP given is invalid. Try again.');
        }
    }
}
