<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Workorder;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\WorkorderResource;
use Symfony\Component\HttpFoundation\Response;

class ContractorWorkordersController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->role !== 'contractor') {
            return $this->respondWithUnprocessableEntity(
                'You do not have permission to access this content.'
            );
        }

        $workorders = Workorder::query()
            ->with('division', 'schemes')
            ->withCount('schemes')
            ->where('contractor_id', $request->user()->id)
            ->get();

        return $this->respondWithSuccess(
            WorkorderResource::collection($workorders),
            Response::HTTP_OK,
            'Contractors workorders'
        );
    }
}
