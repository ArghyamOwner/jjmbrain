<?php

namespace App\Http\Controllers\Api\V1\Jalmitra;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreUserDetailsController extends Controller
{
    use WithApiHelpers;
    
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validate = $request->validate([
            'gender' => ['required'],
            'dob' => ['required'],
            'education' => ['required'],
            'cast' => ['required'],
            'disabled' => ['required'],
            'residence' => ['required'],
            'bpl' => ['required'],
        ]);

        $exists = UserDetail::where('user_id', Auth::id())->exists();
        if($exists)
        {
            return response()->json([
                'message' => 'Data Already Exists.',
            ], 422);
        }
        UserDetail::create($validate + [
            'user_id' => Auth::id()
        ]);
        return $this->respondCreated();
    }
}
