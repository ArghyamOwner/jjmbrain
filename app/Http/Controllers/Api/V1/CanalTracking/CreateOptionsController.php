<?php

namespace App\Http\Controllers\Api\V1\CanalTracking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use Symfony\Component\HttpFoundation\Response;

class CreateOptionsController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = [
            'pipe_use' => config('freshman.pipe_type'),
            'pipe_size' => config('freshman.pipe_size'),
            'pipe_material' => config('freshman.pipe_quality'),
        ];
        return $this->respondWithSuccess(
            $data,
            Response::HTTP_OK,
            'Pipe Options'
        );
    }
}
