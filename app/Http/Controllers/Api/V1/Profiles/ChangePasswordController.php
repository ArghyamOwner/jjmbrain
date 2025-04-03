<?php

namespace App\Http\Controllers\Api\V1\Profiles;

use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Rules\CheckCurrentPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
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
        
        $validatedData = $request->validate([
            'current_password' => ['required', new CheckCurrentPassword()],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        auth()->user()->update([
            'password' => bcrypt($validatedData['password'])
        ]);

        return $this->respondWithNoContent();
    }
}
