<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Scheme;
use App\Models\Beneficiary;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\BeneficiaryResource;
use Symfony\Component\HttpFoundation\Response;

class SchemeBeneficiariesController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Scheme $scheme, Request $request)
    {
        $beneficiaries = Beneficiary::query()
            ->where('scheme_id', $scheme->id)
            ->when($request->s != '', fn($query) => $query->whereLike(['beneficiary_name'], $request->s))
            ->simplePaginate(10);

        return $this->respondWithSuccess(
            BeneficiaryResource::collection($beneficiaries)->response()->getData(true),
            Response::HTTP_OK,
            "Scheme Beneficiaries"
        );
    }
}
