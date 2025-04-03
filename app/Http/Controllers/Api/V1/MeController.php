<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MeController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        return $this->respondWithSuccess(
            [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'phone' => $user->phone,
                'photo' => $user->photo_url,
                'designation' => $user->designation,
                'has_details' => UserDetail::where('user_id', $user->id)->exists(),
                'created' => [
                    'human' => $user->created_at->diffForHumans(),
                    'date' => $user->created_at->toDateString(),
                    'formatted' => $user->created_at->toFormattedDateString(),
                ],
                'doj' => [
                    'human' => $user->doj?->diffForHumans(),
                    'date' => $user->doj?->toDateString(),
                    'formatted' => $user->doj?->toFormattedDateString(),
                ],
            ],
            Response::HTTP_OK,
            'User Details'
        );
    }
}
