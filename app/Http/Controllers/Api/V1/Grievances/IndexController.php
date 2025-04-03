<?php

namespace App\Http\Controllers\Api\V1\Grievances;

use App\Http\Controllers\Controller;
use App\Http\Resources\GrievanceResource;
use App\Models\Grievance;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // dd(auth()->user());
        $grievances = Grievance::query()
            ->with('division', 'createdBy', 'latestAssignedTask.assignedTo', 'assignGrievanceTasks', 'category', 'subCategory', 'images', 'issue')
            ->when(auth()->user()->isJalMitra(), fn($query) =>
                $query->whereRelation('assignGrievanceTasks', 'assigned_to', auth()->id())
            )
            // ->when(
            //     auth()->user()->isSectionOfficer(),
            //     fn($query) =>
            //     $query->whereIn('division_id', auth()->user()->divisions()->pluck('division_id'))
            //     //  ->whereRelation('scheme', 'work_status', '<>', SchemeWorkStatus::HANDED_OVER)
            //         ->whereRelation('assignGrievanceTasks', 'assigned_to', auth()->id())
            // )
            ->simplePaginate();

        return $this->respondWithSuccess(
            GrievanceResource::collection($grievances)->response()->getData(true),
            Response::HTTP_OK,
            'Grievances lists'
        );
    }
}
