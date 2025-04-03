<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;

class GrievanceSubcategoriesController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category, Request $request)
    {
        $subcategories = $category->subCategories()->get()->transform(fn($item) => [
            "postbackText" => $item->id,
            "type" => "text",
            "title" => Str::limit($item->name, 21),
        ]);
         
        return response()->json([
            'message' => 'Grievances Subcategories Lists',
            'data' => $subcategories,
            'status' => 200
        ]);
    }
}
