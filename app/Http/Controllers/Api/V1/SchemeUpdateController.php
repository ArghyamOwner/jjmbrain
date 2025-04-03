<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\FinancialYear;
use App\Models\Scheme;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;

class SchemeUpdateController extends Controller
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
                'message' => 'Scheme Data Not Found.',
            ], 422);
        }

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
        ]);

        Scheme::withoutEvents(function () use ($validated, $scheme) {

            $div = Division::where('old_division_id', $validated['division'])->first();
            $finYear = FinancialYear::where('year', $validated['financial_year'])->first();

            $scheme->update([
                'financial_year_id' => $finYear?->id ?? null,
                'name' => $validated['name'],
                'scheme_type' => $validated['scheme_type'],
                'planned_fhtc' => $validated['planned_fhtc'],
                'approved_on' => $validated['approved_on'],
                'division_id' => $div?->id ?? null,
                'district_id' => $validated['district'],
                // 'block_id' => $validated['block'],
                'lac_id' => $validated['lac_id'],
            ]);

            $scheme->blocks()->sync($validated['block']);
            $scheme->panchayats()->sync($validated['panchayat']);
            $scheme->villages()->sync($validated['village']);
            $scheme->habitations()->sync($validated['habitation']);

            $changes = $scheme->getChanges();

            if(count($changes)){
                unset($changes['updated_at']);
                $updatedKeys = implode(', ', array_keys($changes));

                $scheme->schemeActivity()->create([
                    'scheme_id' => $scheme->id,
                    'activity_type' => 'smt_updated',
                    'content' => $updatedKeys,
                ]);
            }

        });

        return $this->respondCreated();
    }
}
