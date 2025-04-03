<?php

namespace App\Http\Controllers\Api\V1\Schemes;

use App\Models\Scheme;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\SchemeResource;
use Symfony\Component\HttpFoundation\Response;

class ShowController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Scheme $scheme, Request $request)
    {
        $scheme->load(['division.circle', 'district', 'blocks', 'financialYear']);

        return $this->respondWithSuccess(
            new SchemeResource($scheme),
            Response::HTTP_OK,
            'Scheme Details'
        );
    }
}
