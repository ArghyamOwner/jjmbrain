<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Issue;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class GrievanceSubcategoriesIssuesController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(SubCategory $subcategory, Request $request)
    {
        $issues = Issue::where('sub_category_id', $subcategory->id)
            ->get()
            ->transform(fn($item) => [
                'postbackText' => $item->id,
                'type' => 'text',
                'title' => $item->issue,
                'description' => ''
            ]);
         
        return $this->respondWithSuccess(
            $issues,
            Response::HTTP_OK,
            'Grievances Subcategories Issues Lists'
        );
    }
}
