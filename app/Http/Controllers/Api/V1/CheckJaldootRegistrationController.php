<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Jaldoot;
use Illuminate\Http\Request;

class CheckJaldootRegistrationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validate = $request->validate([
            'uin' => ['required'],
        ]);
        $jaldoot = Jaldoot::where('jaldoot_uin', $validate['uin'])->firstOrFail();

        return response()->json([
            'message' => 'Jaldoot Details',
            'data' => $jaldoot,
            'status' => 200,
        ]);
    }
}
