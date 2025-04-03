<?php

namespace App\Http\Controllers\Api\V1\Schemes;

use App\Http\Controllers\Controller;
use App\Models\Scheme;
use Illuminate\Http\Request;

class FinalBillApprovalController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($scheme, Request $request)
    {
        $scheme = Scheme::query()
            ->select('id', 'old_scheme_id', 'verified_by', 'work_status')
            ->with('schemePipeNetworks:id,verification_status,scheme_id,created_at',
                'lithologs:id,scheme_id,well_id,verification_status,created_at')
            ->where('old_scheme_id', $scheme)->first();

        if (!$scheme) {
            return response()->json([
                'message' => 'Scheme Data Not Found.',
                'status' => 422
            ], 422);
        }

        $data = [
            "smt_id" => $scheme->old_scheme_id,
            "verification_status" => $scheme->verified_by ? 'Verified' : 'Pending',
            "work_status" => $scheme?->work_status?->name,
            "lithologs" => $scheme->lithologs->map(fn($data) => [
                'well_id' => $data->well_id,
                'status' => $data->verification_status ?? 'Pending',
                'created_at' => $data->created_at?->format('d-m-Y'),
            ]),
            "trackings" => $scheme->schemePipeNetworks->map(fn($data) => [
                'status' => $data->verification_status ?? 'Pending',
                'created_at' => $data->created_at?->format('d-m-Y'),
            ]),
        ];

        return response()->json([
            'message' => 'Final Bill Approval Data',
            'data' => $data,
            'status' => 200,
        ]);
    }
}
