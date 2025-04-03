<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Attendance;
use Carbon\CarbonImmutable;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\AttendanceTeacher;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\AttendanceTeacherResource;
use App\Traits\WithApiHelpers;

class TeacherStudentAttendancesController extends Controller
{
    use WithApiHelpers;
    
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {
        $year = $request->get('year') ?? now()->format('Y');
        $month = $request->get('month') ?? now()->format('m');

        $startDate = CarbonImmutable::create($year, $month)->startOfMonth();
        $endDate = CarbonImmutable::create($year, $month)->endOfMonth();

        $academicYear = AcademicYear::whereNotNull('activated_at')->first();

        $resource = match($request->get('type')) {
            'student' => AttendanceResource::collection($this->getStudentAttendances($id, $startDate, $endDate, $academicYear->id)),
            'teacher' => AttendanceTeacherResource::collection($this->getTeacherAttendances($id, $startDate, $endDate, $academicYear->id)),
        };

        return $this->respondWithSuccess(
            $resource,
            Response::HTTP_OK,
            'Attendance lists'
        );
    }

    protected function getStudentAttendances($studentId, $startDate, $endDate, $academicYearId)
    {
        return Attendance::query()
            ->whereBetween('date', [$startDate, $endDate])
            ->where('academic_year_id', $academicYearId)
            ->where('student_id', $studentId)
            ->get();
    }

    protected function getTeacherAttendances($teacherId, $startDate, $endDate, $academicYearId)
    {
        return AttendanceTeacher::query()
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->where('academic_year_id', $academicYearId)
            ->where('user_id', $teacherId)
            ->get();
    }
}
