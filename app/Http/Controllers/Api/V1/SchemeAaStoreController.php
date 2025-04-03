<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Scheme;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;

class SchemeAaStoreController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke($scheme, Request $request)
    {
        $scheme = Scheme::where('old_scheme_id', $scheme)->first();
        if (!$scheme) {
            return response()->json([
                'message' => 'Scheme Not Found.',
            ], 422);
        }

        $validated = $request->validate([
            'aa_number'=> ['required'],
            'aa_date'=> ['required', 'date'],
            'aa_document'=> ['required'],
        ]);

        $scheme->schemeAa()->create($validated);

        $scheme->schemeActivity()->create([
            'scheme_id' => $scheme->id,
            'activity_type' => 'smt_scheme_aa',
            'content' => '(SMT) New AA of Scheme Created',
        ]);

        return $this->respondCreated();

    }
}
