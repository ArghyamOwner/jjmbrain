<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Subject;
use App\Models\Milestone;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\SubjectMilestonesResource;

class SubjectMilestonesController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Subject $subject, Request $request)
    {
        $academicYear = AcademicYear::whereNotNull('activated_at')->first();

        $milestones = Milestone::query()
            ->with(['subjectprogress' => fn($query) => $query->where('school_id', auth()->user()->school_id)])
            ->where('subject_id', $subject->id)
            ->where('academic_year_id', $academicYear->id)
            ->get();
 
        return $this->respondWithSuccess(
            SubjectMilestonesResource::collection($milestones),
            Response::HTTP_OK,
            'Subject milestones lists'
        );
    }
}
