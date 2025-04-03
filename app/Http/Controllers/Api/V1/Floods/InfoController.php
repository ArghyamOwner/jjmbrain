<?php

namespace App\Http\Controllers\Api\V1\Floods;

use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\NotificationResource;
use App\Models\SchemeFloodInfo;
use Symfony\Component\HttpFoundation\Response;

class InfoController extends Controller
{
    use WithApiHelpers;
    
    public function __invoke(Request $request)
    {
        $getInundatedInfrastructure =  SchemeFloodInfo::getInundatedInfrastructure();
        $severity =  SchemeFloodInfo::getSeverityOptions();
        $getPartialDamage =  SchemeFloodInfo::getPartialDamageOptions();
        return $this->respondWithSuccess(
        [
            'inundated_infrastructure'=>$getInundatedInfrastructure,
            'severity'=>$severity,
            'partial_damage'=>$getPartialDamage,
        ],
            Response::HTTP_OK,
            'Floods Option'
        );
    }
}
