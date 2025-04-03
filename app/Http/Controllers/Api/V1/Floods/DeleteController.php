<?php

namespace App\Http\Controllers\Api\V1\Floods;

use App\Http\Controllers\Controller;
use App\Models\SchemeFloodInfo as SchemeFloodInfoModel;
use App\Traits\WithApiHelpers;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validate =   $request->validate([
            'floodinfo_id'=> ['required','exists:scheme_flood_infos,id']
        ]);
        $classRoomImage = SchemeFloodInfoModel::findOrFail($validate["floodinfo_id"]);
        $classRoomImage->delete();
        return $this->respondOk();
    }
}
