<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\HelpCategories;
use App\Models\ArticleCategory;

class HelpAndSupportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('helpandsupport.index', [
            // 'categories' => HelpCategories::toOptions()
            'categories' => ArticleCategory::orderBy('order')->get()
        ]);
    }
}
