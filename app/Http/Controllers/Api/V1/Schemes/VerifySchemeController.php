<?php

namespace App\Http\Controllers\Api\V1\Schemes;

use App\Http\Controllers\Controller;
use App\Models\Scheme;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;

class VerifySchemeController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'scheme_id' => ['required'],
        ]);

        $scheme = Scheme::select('name')->where('imis_id', $validated['scheme_id'])->first();

        $data = ['scheme' => $scheme?->name ?? ''];
        return response()->json($data);
    }
}
