<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\School;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassResource;
use Symfony\Component\HttpFoundation\Response;

class SchoolClassesController extends Controller
{
    use WithApiHelpers;
    
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($school)
    {
        $school = School::with('classes')->find($school);

        if (! $school) {
            return $this->respondNotFound();
        }

        return $this->respondWithSuccess(
            ClassResource::collection($school->classes),
            Response::HTTP_OK,
            "Classes associated with school: {$school->name}"
        );
    }
}
