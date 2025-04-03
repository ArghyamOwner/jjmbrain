<?php

namespace App\Http\Controllers\Api\V1\CanalTracking;

use App\Http\Controllers\Controller;
use App\Models\CanalTracking;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EditController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, CanalTracking $canal)
    {
        $validatedData = $request->validate([
            'size' => ['required'],
            'type' => ['required'],
            'quality' => ['required'],
        ]);

        if ($canal->status !== CanalTracking::STATUS_PENDING) {
            return response()->json([
                'message' => 'Pipe Data Cannot be Updated.',
            ], 422);
        }

        $data = tap($canal)->update($validatedData);
        return $this->respondWithSuccess($data, Response::HTTP_OK, 'Pipe Details Updated');
    }
}
