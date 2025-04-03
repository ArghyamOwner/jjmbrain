<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatternResource;
use App\Models\Pattern;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PattensController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $pattern = Pattern::where('type', Pattern::TYPE_LITHOLOGY)->orderBy('category')->get();

        return $this->respondWithSuccess(
            PatternResource::collection($pattern),
            Response::HTTP_OK,
            'Pattern lists'
        );
    }
}
