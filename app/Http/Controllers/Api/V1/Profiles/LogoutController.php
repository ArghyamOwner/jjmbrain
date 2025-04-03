<?php

namespace App\Http\Controllers\Api\V1\Profiles;

use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
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
        auth()->user()->tokens()->delete();

        return $this->respondWithNoContent();
    }
}
