<?php

namespace App\Http\Controllers\Api\V1\Tutorials;

use App\Models\Tutorial;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\TutorialResource;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    use WithApiHelpers;

    public function __invoke(Request $request)
    {
        $tutorials = Tutorial::query()
            ->when(!auth()->user()->isAdministrator(), fn ($query) => $query->where('actor', auth()->user()->role))
            ->simplePaginate();

        return $this->respondWithSuccess(
            TutorialResource::collection($tutorials)->response()->getData(true),
            Response::HTTP_OK,
            'Tutorial lists'
        );
    }
}
