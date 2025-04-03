<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\IssueResource;
use App\Models\Issue;
use App\Models\SubCategory;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GrievanceReasonsController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(SubCategory $subCategory, Request $request)
    {
        $issues = Issue::query()
            ->where('sub_category_id', $subCategory->id)
            ->get();

        return $this->respondWithSuccess(
            IssueResource::collection($issues),
            Response::HTTP_OK,
            'Reasons lists'
        );
    }
}
