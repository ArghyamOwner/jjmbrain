<?php

namespace App\Http\Controllers\Api\V1\Jalmitra;

use App\Http\Controllers\Controller;
use App\Http\Resources\JalmitraSchemeResource;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SchemeController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {   
        $user = auth()->user();
        if (!$user->isJalMitra()) {
            return response()->json([
                'message' => 'Not a valid user.',
            ], 422);
        }

        if (!$user->scheme) {
            return response()->json([
                'message' => 'Not Scheme Attached to Jal-Mitra.',
            ], 422);
        }

        $data = $user->scheme->loadMissing(
            'division', 
            'district', 
            'blocks', 
            'panchayats', 
            'villages', 
            'users', 
            'wucs', 
            'wucs.wucPresidents'
        );

        // dd($data);

        return $this->respondWithSuccess(
            new JalmitraSchemeResource($data), 
            Response::HTTP_OK, 
            'Jal-Mitra Scheme Details');
    }
}
