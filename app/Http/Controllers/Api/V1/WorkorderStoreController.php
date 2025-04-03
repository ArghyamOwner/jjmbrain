<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ContractorDetail;
use App\Models\Division;
use App\Models\Scheme;
use App\Models\Workorder;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;

class WorkorderStoreController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validate = $request->validate([
            'workorder_id' => ['required'],
            'issuingAuthority' => ['required'],
            'division_id' => ['required'],
            'contractor' => ['required'],
            // 'workorderNumber' => ['required'],
            // 'workorderDate' => ['required'],
            'workorderAmount' => ['required'],
            'scheme_id' => ['required'],
            'fhtc_no' => ['nullable'],
        ]);

        $division = Division::where('old_division_id', $validate['division_id'])->first();
        if (!$division) {
            return response()->json([
                'message' => 'Division Not Found.',
            ], 422);
        }

        $contractor = ContractorDetail::with('user')->where('old_contractor_id', $validate['contractor'])->first();
        if (!$contractor) {
            return response()->json([
                'message' => 'Contractor Not Found.',
            ], 422);
        }

        $scheme = Scheme::where('old_scheme_id', $validate['scheme_id'])->first();
        if (!$scheme) {
            return response()->json([
                'message' => 'Scheme Not Found.',
            ], 422);
        }

        $workorder = Workorder::create([
            'old_workorder_id' => $validate['workorder_id'],
            'issuing_authority' => $validate['issuingAuthority'],
            'contractor_id' => $contractor->user ? $contractor?->user?->id : null,
            'circle_id' => $scheme->division->circle->id,
            // 'workorder_number' => $validate['workorderNumber'],
            'workorder_funding_agency' => null,
            'workorder_amount' => floatval($validate['workorderAmount']),
            'workorder_type' => 'work',
            'workorder_status' => 'ongoing',
            'division_id' => $division->id,
            'fhtc_no' => $validate['fhtc_no'],
        ]);

        $workorder->schemes()->sync($scheme->id);

        $workorder->schemeActivity()->create([
            'scheme_id' => $scheme->id,
            'activity_type' => 'smt_workorder_created',
            'content' => '(SMT) New Workorder Created',
        ]);   

        return $this->respondCreated();
    }
}
