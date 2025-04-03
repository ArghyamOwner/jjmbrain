<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Subject;
use App\Models\Milestone;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\WithApiHelpers;

class SubjectMilestonesUpdateController extends Controller
{
    use WithApiHelpers;
    
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Subject $subject, Milestone $milestone, Request $request)
    {
        $academicYear = AcademicYear::whereNotNull('activated_at')->first();

        $milestone->subjectprogress()->create([
            'school_id' => auth()->user()->school_id,
            'subject_id' => $subject->id,
            'academic_year_id' => $academicYear->id
        ]);

        return $this->respondCreated();
    }
}
