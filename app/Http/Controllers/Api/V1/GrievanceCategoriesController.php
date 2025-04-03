<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;

class GrievanceCategoriesController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $categories = Category::get()->transform(fn($item) => [
            "postbackText" => url("api/v1/grievance/categories/{$item->id}/subcategories"),
            "type" => "text",
            "title" => Str::limit($item->name, 21),
        ]);
        
        return response()->json([
            'message' => 'Grievances Categories Lists',
            'data' => $categories,
            'status' => 200
        ]);
    }
}
