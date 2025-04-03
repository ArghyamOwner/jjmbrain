<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Traits\WithApiHelpers;
use Symfony\Component\HttpFoundation\Response;

class SchoolTeachersController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(School $school, Request $request)
    {
        $school->load('teachers');

        return $this->respondWithSuccess(
            UserResource::collection($school->teachers),
            Response::HTTP_OK,
            "Teachers associated with school: {$school->name}"
        );
    }
}
