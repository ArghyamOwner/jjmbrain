<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\FinancialYear;
use App\Models\Scheme;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;

class SchemeStoreController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'financial_year' => ['required'],
            'scheme_type' => ['required'],
            'planned_fhtc' => ['nullable', 'numeric'],
            'approved_on' => ['nullable'],
            'division' => ['required'],
            'district' => ['required'],
            'lac_id' => ['nullable'],
            'block' => ['required'],
            'panchayat' => ['required', 'array', 'min:1'],
            'village' => ['required', 'array', 'min:1'],
            'habitation' => ['required', 'array', 'min:1'],
            'old_scheme_id' => ['required'],
            'parent_id' => ['nullable'],
        ]);

        Scheme::withoutEvents(function () use ($validated) {
            if ($validated['parent_id']) {
                $parentScheme = Scheme::where('old_scheme_id', $validated['parent_id'])->first();
                if (!$parentScheme) {
                    return response()->json([
                        'message' => 'Parent Scheme Data Not Found.',
                    ], 422);
                }
                $parentId = $parentScheme->id;
                $jmId = $parentScheme->user_id;
            }
            $div = Division::where('old_division_id', $validated['division'])->first();
            $finYear = FinancialYear::where('year', $validated['financial_year'])->first();
            $scheme = Scheme::create([
                'financial_year_id' => $finYear?->id ?? null,
                'name' => $validated['name'],
                'scheme_type' => $validated['scheme_type'],
                'planned_fhtc' => $validated['planned_fhtc'],
                'approved_on' => $validated['approved_on'],
                'division_id' => $div?->id ?? null,
                'district_id' => $validated['district'],
                // 'block_id' => $validated['block'],
                'lac_id' => $validated['lac_id'],
                'old_scheme_id' => $validated['old_scheme_id'],
                'parent_id' => $validated['parent_id'] ? $parentId : null,
                'user_id' => $validated['parent_id'] ? $jmId : null
            ]);

            $scheme->blocks()->sync($validated['block']);
            $scheme->panchayats()->sync($validated['panchayat']);
            $scheme->villages()->sync($validated['village']);
            $scheme->habitations()->sync($validated['habitation']);

            $scheme->schemeActivity()->create([
                'scheme_id' => $scheme->id,
                'activity_type' => 'smt_created',
                'content' => '(SMT) New Scheme Created',
            ]);
        });

        return $this->respondCreated();

    }
}
