<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Block;
use App\Models\District;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class DistrictBlockController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (! $district = District::whereId($request->district)->orWhere('name', $request->district)->first()) {
            return response()->json([
                'message' => 'District id is invalid.',
            ], 422);
        }

        $blocks = Block::where('district_id', $district->id)
            ->orderBy('name')
            ->pluck('name')
            ->all();
            
        return $this->respondWithSuccess(
            $blocks,
            Response::HTTP_OK,
            'District Blocks lists'
        );
    }
}
