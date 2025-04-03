<?php

namespace App\Http\Controllers\Api\V1\Profiles;

use App\Http\Controllers\Controller;
use App\Traits\WithApiFileUpload;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UpdateProfilePic extends Controller
{
    use WithApiHelpers;
    use WithApiFileUpload;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (!is_null(auth()->user()->photo) &&
            Storage::disk('profile')->exists(auth()->user()->photo)
        ) {
            Storage::disk('profile')->delete(auth()->user()->photo);
        }
        auth()->user()->update([
            'photo' => $this->createFileObject($request->photo)->storePublicly('/', 'profile'),
        ]);

        return $this->respondWithSuccess([
            'profile_photo' => auth()->user()->photo_url,
        ], Response::HTTP_OK, 'Success');

    }
}
