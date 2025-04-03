<?php

namespace App\Http\Controllers\Api\V1\Assets;

use App\Enums\AssetType;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssetTypeResource;
use Symfony\Component\HttpFoundation\Response;

class TypeController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $type = AssetType::cases();

        return $this->respondWithSuccess(
            AssetTypeResource::collection($type),
            Response::HTTP_OK,
            'Asset Types'
        );
    }
}
