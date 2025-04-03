<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\WucResource;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WucDetailsController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (!auth()->user()?->wucMember?->wuc) {
            return response()->json([
                'message' => 'WUC Not Found.',
            ], 422);
        }

        $wuc = auth()->user()?->wucMember?->wuc->load('district', 'block', 'revenueCircle', 'wucMembers', 'schemes');

        return $this->respondWithSuccess(
            new WucResource($wuc),
            Response::HTTP_OK,
            'WUC Details'
        );
    }
}
