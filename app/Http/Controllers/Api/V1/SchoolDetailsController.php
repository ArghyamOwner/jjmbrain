<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolResource;
use App\Traits\WithApiHelpers;
use Symfony\Component\HttpFoundation\Response;

class SchoolDetailsController extends Controller
{
    use WithApiHelpers;
    
    public function __invoke($school)
    {
        $school = School::with(['district', 'block'])->findOrFail($school);

        return $this->respondWithSuccess(
            new SchoolResource($school),
            Response::HTTP_OK,
            'School Details'
        );
    }
}
