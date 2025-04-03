<?php

namespace App\Http\Controllers\Api\V1\Notices;

use App\Models\Notice;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\NoticeResource;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    use WithApiHelpers;

    public function __invoke(Request $request)
    {
        $notices = Notice::query()
        ->when(!auth()->user()->isAdministrator(), fn ($query) => $query->where('role', auth()->user()->role))
        ->simplePaginate();

        return $this->respondWithSuccess(
            NoticeResource::collection($notices)->response()->getData(true),
            Response::HTTP_OK,
            'Notice lists'
        );
    }
}
