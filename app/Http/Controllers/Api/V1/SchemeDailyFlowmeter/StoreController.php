<?php

namespace App\Http\Controllers\Api\V1\SchemeDailyFlowmeter;

use App\Http\Controllers\Controller;
use App\Models\SchemeDailyFlowmeter;
use App\Traits\WithApiFileUpload;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    use WithApiHelpers;
    use WithApiFileUpload;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $schemeId = auth()->user()?->scheme?->id;

        if (!$schemeId) {
            return response()->json([
                'message' => 'Jal-Mitra Not Assigned to any Scheme.',
            ], 422);
        }

        $validate = $request->validate([
            'status' => ['required'],
            'image' => ['nullable'],
        ]);

        $update = SchemeDailyFlowmeter::create($validate + [
            'scheme_id' => $schemeId,
            'updated_by' => Auth::id(),
        ]);

        if (!blank($validate['image'])) {
            $file = $this->createFileObject($validate['image']);
            $update->update([
                'image' => $file->storePublicly('/', 'flowmeter'),
            ]);
        }
        return $this->respondCreated();
    }
}
