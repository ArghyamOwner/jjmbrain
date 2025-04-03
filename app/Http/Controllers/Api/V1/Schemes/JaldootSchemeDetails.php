<?php

namespace App\Http\Controllers\Api\V1\Schemes;

use App\Http\Controllers\Controller;
use App\Models\Jaldoot;
use App\Models\Scheme;
use Illuminate\Http\Request;

class JaldootSchemeDetails extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'jaldoot_uin' => ['required'],
        ]);

        $jaldoot = Jaldoot::query()
            ->with('scheme:id,name,division_id,imis_id', 'scheme.villages', 'scheme.division')
            ->where('jaldoot_uin', $validated['jaldoot_uin'])->first();

        if (!$jaldoot) {
            return response()->json([
                'message' => 'Invalid Data.',
            ], 422);
        }
        
        $data = [
            'scheme' => ($jaldoot->scheme?->imis_id) . '. ' . $jaldoot->scheme?->name,
            'division' => $jaldoot->scheme?->division?->name,
            'villages' => $jaldoot->scheme->village_names,
        ];

        return response()->json($data);
    }
}
