<?php

namespace App\Http\Controllers\Api\V1\Schemes;

use App\Http\Controllers\Controller;
use App\Models\Panchayat;
use App\Models\Scheme;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PanchayatWiseIndexController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'panchayat_id' => ['required'],
        ]);

        $panchayat = Panchayat::select('panchayat_name')->findOrFail($validated['panchayat_id']);

        $schemes = Scheme::query()
            ->select('id', 'name', 'imis_id')
            ->when($validated['panchayat_id'], function ($query) use ($validated) {
                $query->whereHas('panchayats', function ($subQuery) use ($validated) {
                    $subQuery->where('panchayats.id', $validated['panchayat_id']);
                });
            })->lazy();

        $formattedResponse = '';
        foreach ($schemes as $scheme) {
            $formattedResponse .= ($scheme->imis_id) . '. ' . $scheme->name . "\n";
        }
        $data = ['schemes' => $formattedResponse, 'panchayat' => $panchayat->panchayat_name];
        return response()->json($data);

        // return $this->respondWithSuccess(
        //     SchemeResource::collection($schemes)->response()->getData(true),
        //     Response::HTTP_OK,
        //     'Scheme lists'
        // );
    }
}
