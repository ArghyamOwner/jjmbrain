<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenditureCategoryResource;
use App\Models\ExpenditureCategory;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenditureCategoryController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $categories = ExpenditureCategory::get();

        return $this->respondWithSuccess(
            ExpenditureCategoryResource::collection($categories),
            Response::HTTP_OK,
            'Expenditure Category lists'
        );
    }
}