<?php

namespace App\Http\Controllers\Api\V1\Schemes;

use App\Http\Controllers\Controller;
use App\Models\Scheme;
use Illuminate\Http\Request;

class LithologStatusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($scheme, Request $request)
    {
        $scheme = Scheme::query()
            ->select('id', 'old_scheme_id')
            ->with('lithologs:id,scheme_id,well_id,verification_status,created_at')
            ->where('old_scheme_id', $scheme)->first();

        if (!$scheme) {
            return response()->json([
                'message' => 'Scheme Data Not Found.',
                'status' => 422,
            ], 422);
        }

        $data = [
            "smt_id" => $scheme->old_scheme_id,
            "lithologs" => $scheme->lithologs->map(fn($data) => [
                'well_id' => $data->well_id,
                'status' => $data->verification_status ?? 'Pending',
                'created_at' => $data->created_at?->format('d-m-Y'),
            ]),
        ];

        return response()->json([
            'message' => 'Litholog Status Details',
            'data' => $data,
            'status' => 200,
        ]);
    }
}
