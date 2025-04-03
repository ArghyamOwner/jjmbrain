<?php

namespace App\Http\Controllers\Api\V1\Notifications;

use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\NotificationResource;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $notifications = auth()->user()->notifications()->take(25)->latest('created_at')->get();

        return $this->respondWithSuccess(
            NotificationResource::collection($notifications)->response()->getData(true),
            Response::HTTP_OK,
            'Notification lists'
        );
    }
}
