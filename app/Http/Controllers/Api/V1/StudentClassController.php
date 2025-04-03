<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassResource;
use Symfony\Component\HttpFoundation\Response;

class StudentClassController extends Controller
{
    use WithApiHelpers;
    
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Student $student, Request $request)
    {
        $student->load('class');

        return $this->respondWithSuccess(
            ClassResource::make($student->class),
            Response::HTTP_OK,
            "Classes associated with a student"
        );
    }
}
