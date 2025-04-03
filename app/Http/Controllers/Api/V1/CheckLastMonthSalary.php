<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLastMonthSalary extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $exists = Salary::query()
            ->where('month', now()->subMonth()->format('m'))
            ->where('user_id', Auth::id())
            ->exists();

        return $this->respondWithSuccess([
            'salary_received' => $exists,
            'month' => (int)now()->subMonth()->format('m')
        ], Response::HTTP_OK, 'Last Month Salary');
    }
}
