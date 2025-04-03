<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Attendance;
use Illuminate\Support\Str;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Enums\AttendanceStatus;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Enum;

class StudentAttendanceController extends Controller
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
        $validated = $request->validate([
            'class_id' => ['required', Rule::exists('classes','id')],
            'attendances' => ['required', 'array', 'min:1'],
            'attendances.*.student_id' => ['required', 'exists:students,id'],
            'attendances.*.status' => ['required', new Enum(AttendanceStatus::class)]
        ]);

        // "class_id": "01gv090at0888zn4mx9e8bnmh6,
        // "attendances": [
        //     {
        //         "student_id": 1, 
        //         "status": "present" // absent/leave
        //     },
        //     {
        //         "student_id": 2,
        //         "status": "present" // absent/leave
        //     }
        // ]

        try {
            return DB::transaction(function () use ($validated) {
                $academicYear = AcademicYear::whereNotNull('activated_at')->first();
        
                $attendances = collect($validated['attendances'])->map(function ($attendance) use ($validated, $academicYear) {
                    return [
                        'id' => strtolower((string) Str::ulid()),
                        'user_id' => auth()->id(),
                        'academic_year_id' => $academicYear->id,
                        'student_id' => $attendance['student_id'],
                        'class_id' => $validated['class_id'],
                        'school_id' => auth()->user()->school_id,
                        'date' => today()->format('Y-m-d'),
                        'status' => $attendance['status'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })->all();

                Attendance::insert($attendances);

                return $this->respondCreated();
            });
        } catch (\Exception $e) {
            // return $e->getMessage();
            return $this->respondWithUnprocessableEntity('Something went wrong. Try again.');
        }
    }
}
