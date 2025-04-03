<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SalaryResource;
use App\Models\Salary;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SalaryDetailsController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // $year = $year ?? now()->format('Y');

        $year = $request->query('year') ?? now()->format('Y');

        $salaries = Salary::query()
            ->with('user')
            ->where('user_id', Auth::id())
            ->where('year', $year)
            ->get();

        return $this->respondWithSuccess(
            SalaryResource::collection($salaries),
            Response::HTTP_OK,
            'Salary lists'
        );
    }
}
