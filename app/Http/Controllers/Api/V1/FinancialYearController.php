<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\FinancialYear;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\FinancialYearResource;
use Symfony\Component\HttpFoundation\Response;


class FinancialYearController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
          $years = FinancialYear::all();

        return $this->respondWithSuccess(
            FinancialYearResource::collection($years),
            Response::HTTP_OK,
            'Financial Years'
        );
    }
}