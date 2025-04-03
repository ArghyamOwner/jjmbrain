<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
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
        $request->validate([
            'login' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        
        $login = $request->input('login');

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $login)->first(); 
        } else {
            $user = User::where('school_code', $login)->first(); 
        }

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['The provided credentials are incorrect.']
            ]);
        }

        return $this->respondWithSuccess(
            [
                'token_type' => 'Bearer',
                'access_token' => $user->createToken($request->device_name)->plainTextToken,
                'user' => new UserResource($user),
            ],
            Response::HTTP_CREATED,
            'Token created'
        );
    }
}
