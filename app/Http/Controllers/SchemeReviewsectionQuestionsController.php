<?php

namespace App\Http\Controllers;

use App\Models\ReviewSection;
use App\Models\Scheme;
use Illuminate\Http\Request;

class SchemeReviewsectionQuestionsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Scheme $scheme, ReviewSection $reviewsection, Request $request)
    {
        return view('schemes.reviewsection-questions', [
            'reviewSectionTitle' => $reviewsection->title,
            'reviewSectionId' => $reviewsection->id,
            'reviewSectionImage' => $reviewsection->photoUrl,
            'schemeId' => $scheme->id,
            'schemeName' => $scheme->name,
        ]);
    }
}
