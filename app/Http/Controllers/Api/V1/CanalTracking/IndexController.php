<?php

namespace App\Http\Controllers\Api\V1\CanalTracking;

use App\Http\Controllers\Controller;
use App\Http\Resources\CanalTrackingResource;
use App\Models\CanalTracking;
use App\Models\Scheme;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Scheme $scheme, $type)
    {
        $trackings = CanalTracking::query()
            ->select('id',
                'type',
                'size',
                'distance',
                'quality',
                'status',
                'approved_by',
                'created_by',
                'approved_on',
                'created_at',
                // 'geojson', // Remove this after app update
                // DB::raw('CASE WHEN geojson IS NOT NULL THEN true ELSE false END AS geojson_exists'))
                // DB::raw('geojson IS NOT NULL AS geojson_exists'),
                'has_geojson')
            ->with('createdBy:id,name', 'approvedBy:id,name')
            ->where('scheme_id', $scheme->id)
            ->when($type === 'track', fn($query) => $query->whereNotNull('geojson'))
            ->when($type === 'untrack', fn($query) => $query->whereNull('geojson'))
            ->orderBy('created_at', 'desc')
            ->simplePaginate(3);

        return $this->respondWithSuccess(
            CanalTrackingResource::collection($trackings)->response()->getData(true),
            Response::HTTP_OK,
            'Canal Tracking lists'
        );

    }
}
