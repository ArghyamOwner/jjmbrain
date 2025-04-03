<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Jaldoot;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;

class UpdateJaldootController extends Controller
{
    use WithApiHelpers;

    public function __invoke(Request $request)
    {
        $validate = $request->validate([
            'student_name' => ['required'],
            'student_phone' => ['required'],
            'jaldoot_id' => ['required'],
            'gender' => ['required', 'in:male,female,others'],
            'age' => ['required', 'numeric'],
            'class' => ['required', 'numeric'],
        ]);

        $jaldoot = Jaldoot::where('jaldoot_uin', $validate['jaldoot_id'])->first();

        if (!$jaldoot) {
            return response()->json([
                'message' => 'Jaldoot Not Found.',
            ], 422);
        }

        $jaldoot->update([
            'student_name' => $validate['student_name'] ?? $jaldoot->student_name,
            'student_phone' => $validate['student_phone'] ?? $jaldoot->student_phone,
            'gender' => $validate['gender'] ?? $jaldoot->gender,
            'age' => $validate['age'] ?? $jaldoot->age,
            'class' => $validate['class'] ?? $jaldoot->class,
        ]);

        return $this->respondOk();
    }
}
