<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Enums\AttendanceStatus;
use App\Models\AttendanceTeacher;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\DistanceWithinRadius;
use Symfony\Component\HttpFoundation\Response;

class TeacherAttendanceController extends Controller
{
    use WithApiHelpers;
    use DistanceWithinRadius;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(User $teacher, Request $request)
    {
        $validatedData = $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $teacher->load('school');
 
        if (blank($teacher->school->latitude) && blank($teacher->school->longitude)) {
            return $this->respondWithUnprocessableEntity('No coordinates found.');
        }

        $distance = $this->getDistance(
            $teacher->school->latitude,
            $teacher->school->longitude,
            $latitude = $validatedData['latitude'], 
            $longitude = $validatedData['longitude']
        );

        if ($distance >= 69) {
            return $this->respondWithError(
                Response::HTTP_NOT_ACCEPTABLE,
                "Attendance can only be given within/nearby the office premises."
            );
        }

        if ($distance <= 69) {
            return DB::transaction(function () {
                $academicYear = AcademicYear::whereNotNull('activated_at')->first();

                $dailyattendance = AttendanceTeacher::query()
                    ->where('user_id', auth()->id())
                    ->where('academic_year_id', $academicYear->id)
                    ->where('attendance_date', today())
                    ->first();

                if (!$dailyattendance) {
                    AttendanceTeacher::create([
                        'user_id' => auth()->id(),
                        'school_id' => auth()->user()->school_id,
                        'academic_year_id' => $academicYear->id,
                        'attendance_date' => today()->format('Y-m-d'),
                        'attendance_month' => today()->month,
                        'attendance_year' => today()->year,
                        'punch_in' => now(),
                        'punch_in_time' => now()->format('h:i A')
                    ]);

                    return $this->respondCreated('Success! Your punch in has been recorded.');
                } else {
                    $dailyattendance->update([
                        'punch_out' => now(),
                        'punch_out_time' => now()->format('h:i A'),
                        'working_hours' => round(Carbon::parse($dailyattendance->punch_in)->diffInHours(now()), 2),
                    ]);
                    
                    return $this->respondCreated('Success! Your punch out has been recorded.');
                }
            });
        }
    }
}
