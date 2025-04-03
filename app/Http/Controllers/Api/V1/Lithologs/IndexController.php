<?php

namespace App\Http\Controllers\Api\V1\Lithologs;

use App\Http\Controllers\Controller;
use App\Http\Resources\LithologResource;
use App\Models\Litholog;
use App\Models\Scheme;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Scheme $scheme, Request $request)
    {
        $lithologs = Litholog::query()
            ->where('scheme_id', $scheme->id)
            ->simplePaginate();

        return $this->respondWithSuccess(
            LithologResource::collection($lithologs)->response()->getData(true),
            Response::HTTP_OK,
            'Litholog lists'
        );
    }
}
