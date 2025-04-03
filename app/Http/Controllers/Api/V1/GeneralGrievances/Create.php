<?php

namespace App\Http\Controllers\Api\V1\GeneralGrievances;

use App\Http\Controllers\Controller;
use App\Models\GeneralGrievance;
use App\Traits\WithApiFileUpload;
use App\Traits\WithApiHelpers;
use App\Traits\WithUniqueRandomNumberGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Create extends Controller
{
    use WithApiHelpers;
    use WithApiFileUpload;
    use WithUniqueRandomNumberGenerator;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required'],
            // 'division_id' => ['required'],
            // 'district_id' => ['nullable'],
            // 'block_id' => ['nullable'],
            // 'scheme_id' => ['nullable'],
            'description' => ['required'],
            'image' => ['nullable'],
        ]);

        $user = auth()->user();

        if(! $user->divisions?->pluck('id')?->first()){
            return response()->json([
                'message' => 'No Division assigned to Jal-Mitra',
            ], 422);
        }

        $grievance = GeneralGrievance::create($validated + [
            'reference_no' => $this->generateUniqueRandomNumber(),
            'created_by' => Auth::id(),
            'division_id' => $user->divisions?->pluck('id')?->first(),
            'district_id' => $user->districts?->pluck('id')?->first(),
            'scheme_id' => $user->scheme?->id,
        ]);

        if (!blank($validated['image'])) {
            $file = $this->createFileObject($validated['image']);

            $grievance->update([
                'image' => $file->storePublicly('/', 'grievances'),
            ]);
        }
        return $this->respondCreated();
    }
}
