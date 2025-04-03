<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Workorder;
use Illuminate\Http\Request;
use App\Models\ContractorGrievance;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Enum;
use App\Enums\ContractorGrievanceTypes;
use App\Traits\WithApiFileUpload;
use App\Traits\WithApiHelpers;

class ContractorWorkorderGrievanceController extends Controller
{
    use WithApiHelpers;
    use WithApiFileUpload;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Workorder $workorder, Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', new Enum(ContractorGrievanceTypes::class)],
            'remarks' => ['required'],
            'image' => ['nullable'],
        ]);

        $grievance = ContractorGrievance::create([
            'user_id' => auth()->id(),
            'workorder_id' => $workorder->id,
            'type' => $validated['type'],
            'remarks' => $validated['remarks'],
        ]);

        if (! blank($validated['image'])) {
            $file = $this->createFileObject($validated['image']);

            $grievance->update([
                'image' => $file->storePublicly('/', 'grievances')
            ]);
        }

        return $this->respondCreated();
    }
}
