<?php

namespace App\Http\Controllers\Api\V1\Floods;

use Illuminate\Http\Request;
use App\Models\SchemeFloodInfo as SchemeFloodInfoModel;
use App\Traits\WithApiFileUpload;
use App\Http\Controllers\Controller;
use App\Traits\WithApiHelpers;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    use WithApiFileUpload;
    use WithApiHelpers;

    public function __invoke(Request $request)
    {
        // $getInundatedInfrastructure = SchemeFloodInfoModel::getInundatedInfrastructure
        $validatedData = $request->validate([
            'scheme_id' => ['required', 'string','exists:schemes,id'],
            // 'user_id' => ['required', 'string','exists:users,id'],
            'start_date' => ['required', 'date'],
            'water_stagnation_period' => ['required', 'string'],
            'inundated_infrastructure' => ['required', 'array'],
            'severity' => ['required', 'string'],//,'in:High,Medium,Low'
            'partial_damage' => ['required', 'string'],
            'approx_inundation_height' => ['required', 'numeric'],
        ]);
        $exists = SchemeFloodInfoModel::whereDate('start_date', '=', $validatedData['start_date'])->exists();
        if ($exists) {
            return $this->respondWithError(Response::HTTP_FORBIDDEN, "For Today Floods Info is already exists");
        }
        $validatedData["user_id"] = auth()->user()->id;
        $validatedData["inundated_infrastructure"] = implode(', ', $validatedData["inundated_infrastructure"]);
        SchemeFloodInfoModel::create($validatedData);
        return $this->respondCreated();
    }
}
