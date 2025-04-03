<?php

namespace App\Http\Controllers\Api\V1\Wuc;

use App\Http\Controllers\Controller;
use App\Models\OAndMExpenditure;
use App\Models\Wuc;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OAndMExpenditureStoreController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Wuc $wuc,Request $request)
    {
        $validated = $request->validate([
            'financial_year_id' => ['required',  Rule::exists('financial_years', 'id')],
            'month' => ['required'],
            'manpower' => ['required', 'numeric'],
            'maintenance' => ['required', 'numeric'],
            'electricity' => ['required', 'numeric'],
            'chemical' => ['required', 'numeric'],
            'total_monthly_cost' => ['required', 'numeric'],
            'uc_document' => ['nullable'],
        ]);
        
        $expenditure = OAndMExpenditure::create($validated + [
            'wuc_id' => $wuc->id
        ]);

        if (! blank($validated['uc_document'])) {
            $file = $this->createFileObject($validated['uc_document']);

            $expenditure->update([
                'uc_document' => $file->storePublicly('/', 'wuc')
            ]);
        }

        return $this->respondCreated();
    }
}