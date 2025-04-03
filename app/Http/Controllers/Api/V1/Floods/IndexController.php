<?php

namespace App\Http\Controllers\Api\V1\Floods;

use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\NotificationResource;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SchemeFloodInfo as  FloodInfoModel;

class IndexController extends Controller
{
    use WithApiHelpers;
    use WithApiHelpers;
    
    // public function __invoke(Request $request)
    // {
    //     $getInundatedInfrastructure =  SchemeFloodInfo::getInundatedInfrastructure();
    //     return $this->respondWithSuccess(
    //         NotificationResource::collection($getInundatedInfrastructure)->response()->getData(true),
    //         Response::HTTP_OK,
    //         'Floods Lists'
    //     );
    // }
    public function __invoke()
    {
        $entity = FloodInfoModel::where('user_id', '=', auth()->user()->id )->simplePaginate(10)->through(fn ($item) => [
        'id' => $item->id,
        'user_id'=> $item->user_id,
        'scheme_id'=> $item->scheme_id,
        'start_date'=> $item->start_date,
        'water_stagnation_period'=> $item->water_stagnation_period,
        'inundated_infrastructure' => explode(',',$item->inundated_infrastructure),
        'severity'=> $item->severity,
        'partial_damage'=> $item->partial_damage,
        'approx_inundation_height'=> $item->approx_inundation_height,
        ]);
        return $this->respondWithJsonPaginate($entity);
    }
}
// php artisan make:migration add_user_id_index_to_scheme_flood_infos  --table=scheme_flood_infos