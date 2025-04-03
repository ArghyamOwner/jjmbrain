<?php

namespace App\Http\Controllers\Api\V1\Circle;

use App\Http\Controllers\Controller;
use App\Http\Resources\CircleResource;
use App\Models\Circle;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\WithApiHelpers;

class IndexController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $circles = Circle::query()
            ->orderBy('name')
            ->get();

        return $this->respondWithSuccess(
            CircleResource::collection($circles),
            Response::HTTP_OK,
            'Circles'
        );
    }
}