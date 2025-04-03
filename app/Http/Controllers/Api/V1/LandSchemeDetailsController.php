<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Scheme;
use Illuminate\Http\Request;

class LandSchemeDetailsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($schemeId, Request $request)
    {
        $scheme = Scheme::query()
            ->select('id', 'name', 'imis_id', 'division_id', 'district_id')
            ->with('division', 'district', 'villages', 'blocks', 'panchayats', 'habitations', 'users:id,name,phone')
            ->where('imis_id', $schemeId)->first();

        if (!$scheme) {
            return response()->json([
                'message' => 'Scheme Data Not Found.',
                'status' => 422,
            ], 422);
        }

        foreach($scheme->users as $sos){
            $sectionsOfficers[] = [
                'name' => $sos->name,
                'phone' => $sos->phone
            ]; 
        }

        $data = [
            'scheme_id' => $scheme->imis_id,
            'scheme_name' => $scheme->name,
            'division' => $scheme->division?->name,
            'district' => $scheme->district?->name,
            'blocks' => $scheme->block_names,
            'panchayats' => $scheme->panchayat_names,
            'habitations' => $scheme->habitation_names,
            'villages' => $scheme->habitation_names,
            'section_officers' => $sectionsOfficers ?? Null
        ];
        return response()->json([
            'message' => 'Scheme Details',
            'data' => $data,
            'status' => 200,
        ]);
    }
}
