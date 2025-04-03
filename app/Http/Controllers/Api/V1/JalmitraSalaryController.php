<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JalmitraSalaryController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validate = $request->validate([
            'month' => ['required'],
            'year' => ['required'],
        ]);

        Salary::create([
            'user_id' => Auth::id(),
            'month' => sprintf('%02d', $validate['month']),
            'year' => $validate['year']
        ]);

        return $this->respondCreated();
    }
}
