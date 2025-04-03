<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class IndexController extends Controller
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
        $users = User::latest('id')->simplePaginate(10);

        return $this->respondWithSuccess(
            UserResource::collection($users)->response()->getData(true),
            Response::HTTP_OK,
            'User lists'
        );
    }
}
