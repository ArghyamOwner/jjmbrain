<?php

namespace App\Http\Controllers\Api\V1\CanalTracking;

use App\Http\Controllers\Controller;
use App\Http\Resources\CanalTrackingResource;
use App\Models\CanalTracking;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, CanalTracking $canalTracking)
    {
        $canalTracking->loadMissing('createdBy:id,name', 'approvedBy:id,name');

        $data = [
            'id' => $canalTracking->id,
            'type' => $canalTracking->type,
            'size' => $canalTracking->size,
            'distance' => $canalTracking->distance,
            'quality' => $canalTracking->quality,
            'status' => $canalTracking->status,
            'approved_by' => $canalTracking->approvedBy?->name,
            'created_by' => $canalTracking->createdBy?->name,
            'approved_on' => [
                'human' => $canalTracking->approved_on?->diffForHumans(),
                'date' => $canalTracking->approved_on?->toDateString(),
                'formatted' => $canalTracking->approved_on?->toFormattedDateString(),
            ],
            'created_at' => [
                'human' => $canalTracking->created_at?->diffForHumans(),
                'date' => $canalTracking->created_at?->toDateString(),
                'formatted' => $canalTracking->created_at?->format("jS M Y h:i A"),
                // 'datetime' => $this->created_at->toFor
            ],
            'geojson' => $canalTracking->geojson,
        ];
        return $this->respondWithSuccess(
            $data,
            Response::HTTP_OK,
            'Canal Tracking Details'
        );
    }
}
