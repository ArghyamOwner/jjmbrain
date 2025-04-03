<?php

namespace App\Http\Controllers\Api\V1\Lithologs;

use App\Http\Controllers\Controller;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptionsController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = [
            'drilling_types' => config('freshman.drilling_types'),
            'hole_diameters' => config('freshman.hole_diameters'),
            'casing_sizes' => config('freshman.casing_sizes'),
            'compressor_capacity_units' => config('freshman.compressor_capacity_units'),
        ];
        return $this->respondWithSuccess(
            $data,
            Response::HTTP_OK,
            'Litholog Options'
        );
    }
}
