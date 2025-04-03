<?php

namespace App\Http\Controllers\Api\V1\Wuc;

use App\Http\Controllers\Controller;
use App\Models\OAndMDemand;
use App\Models\Wuc;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OAndMDemandStoreController extends Controller
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
            'total_monthly_demand' => ['required', 'numeric']
        ]);
        
        $expenditure = OAndMDemand::create($validated + [
            'wuc_id' => $wuc->id
        ]);

        return $this->respondCreated();
    }
}