<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JalshalaResource;
use App\Models\Jalshala;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class JaldootJalshalaSchemesController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // $jaldoot = "B099JS01JD23";
        $validate = $request->validate([
            'jaldoot_uin' => ['required'],
        ]);

        $jalshalaUin = Str::before($validate['jaldoot_uin'], 'JD');

        $jalshala = Jalshala::query()
            ->select("id", "jalshala_uin", "venue")
            ->with("schemes:id,name,imis_id", "district:id,name", "block:id,name")
            ->where("jalshala_uin", $jalshalaUin)
            ->get();

        return $this->respondWithSuccess(
            JalshalaResource::collection($jalshala),
            Response::HTTP_OK,
            'Jalshala with Scheme details'
        );
    }
}
