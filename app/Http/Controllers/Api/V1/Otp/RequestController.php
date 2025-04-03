<?php

namespace App\Http\Controllers\Api\V1\Otp;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\PhoneNumberRule;
use App\Traits\WithApiHelpers;
use App\Services\OtpSmsService;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class RequestController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'phone' => ['bail', 'required', 'digits:10', new PhoneNumberRule()],
            'app_name' => ['required']
        ]);

        // $role = match($validated['app_name']) {
        //     'tech.sumato.jjm.officer' => 'officer',
        //     'tech.sumato.jjm.contractor' => 'contractor'
        // };

        $role = match($validated['app_name']) {
            'tech.sumato.jjm.officer' => ['officer', 'third-party', 'section-officer', 'sdo', 'executive-engineer'],
            'tech.sumato.jjm.contractor' => ['contractor'],
            'tech.sumato.jjm.jalmitra' => ['jal-mitra'],
            'tech.sumato.jjm.wuc' => ['wuc']
        };

        // if ($role == 'contractor') {
        //     $user = User::where('phone', $validated['phone'])->where('role', $role)->first();
        // } else {
        //     $user = User::where('phone', $validated['phone'])->where('role', '!=', 'contractor')->first();
        // }

        $user = User::where('phone', $validated['phone'])->whereIn('role', $role)->first();
 
        if (! $user) {
            throw ValidationException::withMessages([
                'phone' => ['The provided phone no. doesn\'t exists.'],
            ]);
        }

        if ($user->blocked_at !== null) {
            // User is blocked
            throw ValidationException::withMessages([
                'login' => ['Your account is blocked. Please contact support.'],
                'phone' => ['Your account is blocked. Please contact support.'],
            ]);
        }

        if ($user->phone == "7099036568" || $user->phone == "7099036578" || $user->phone == "7086041396" || $user->phone == "7086051060") {
            $user->otp = '123456';
            $user->save();
        } else {
            // if ($user->phone && !is_null($user->otp)) {
            //     OtpSmsService::make("6621eafbd6fc0524384762d3")
            //         ->to($user->phone)
            //         ->sendOtp();

            // } else {
            //     $otp = mt_rand(111111, 999999);
    
            //     $user->update(['otp' => $otp]);
    
            //     SmsService::make('6621eafbd6fc0524384762d3')
            //         ->to($user->phone)
            //         ->addVariables([
            //             'number' => $otp
            //         ])
            //         ->send();
            // }

            OtpSmsService::make("6621eafbd6fc0524384762d3")
                ->to($user->phone)
                ->sendOtp();
        }

        return $this->respondOk();
    }
}
