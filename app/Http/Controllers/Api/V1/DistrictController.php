<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\District;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class DistrictController extends Controller
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
        return $this->respondWithSuccess(
            District::orderBy('name')->pluck('name')->all(),
            Response::HTTP_OK,
            'District lists'
        );
    }
}
