<?php

namespace App\Http\Controllers\Api\V1\Lithologs;

use App\Http\Controllers\Controller;
use App\Http\Resources\LithologyResource;
use App\Models\Litholog;
use App\Models\Lithology;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LithologyIndexController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Litholog $litholog, Request $request)
    {
        $lithology = Lithology::query()
            ->with('pattern')
            ->where('litholog_id', $litholog->id)
            ->get();

        return $this->respondWithSuccess(
            LithologyResource::collection($lithology),
            Response::HTTP_OK,
            'Litholog lists'
        );
    }
}
