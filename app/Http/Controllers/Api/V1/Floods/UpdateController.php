<?php

namespace App\Http\Controllers\Api\V1\Floods;

use App\Http\Controllers\Controller;
use App\Models\SchemeFloodInfo as SchemeFloodInfoModel;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(SchemeFloodInfoModel $schemeFloodInfo, Request $request)
    {
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
        $validatedData["inundated_infrastructure"] = implode(', ', $validatedData["inundated_infrastructure"]);
        $validatedData["user_id"] = auth()->user()->id;
        $schemeFloodInfo->update($validatedData);
        return $this->respondOk();
    }
}
