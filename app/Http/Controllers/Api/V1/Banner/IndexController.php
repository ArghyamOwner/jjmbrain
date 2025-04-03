<?php

namespace App\Http\Controllers\Api\V1\Banner;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
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
        $validate = $request->validate([
            'app_name' => ['required'],
        ]);

        $banners = Banner::query()
            ->where('app_name', $validate['app_name'])
            ->isActive()
            ->latest('id')
            ->limit(10)
            ->get();

        return $this->respondWithSuccess(
            BannerResource::collection($banners),
            Response::HTTP_OK,
            'Banners'
        );
    }
}
