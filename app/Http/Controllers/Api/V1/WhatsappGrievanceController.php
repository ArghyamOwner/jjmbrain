<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Grievance;
use App\Models\Scheme;
use App\Models\SubCategory;
use App\Traits\WithApiHelpers;
use App\Traits\WithUniqueRandomNumberGenerator;
use Illuminate\Http\Request;

class WhatsappGrievanceController extends Controller
{
    use WithApiHelpers;
    use WithUniqueRandomNumberGenerator;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'scheme_id' => ['required'],
            'sub_category_id' => ['required'],
            'name' => ['required'],
            'image' => ['nullable'],
            // 'phone' => ['required', 'digits:10'],
            'phone' => ['nullable'],
            'wid' => ['nullable'],
        ]);

        // $file = $this->createFileObject($validated['image']);
        // $validated['attachment'] = $file->storePublicly('/', 'grievances');

        // TODO: Grab scheme id from imis_id
        $scheme = Scheme::with('latestBlock')->where('imis_id', $validated['scheme_id'])->first();

        $subCategory = SubCategory::with('category')->where('id', $validated['sub_category_id'])->first();

        if (!$subCategory) {
            return $this->respondWithUnprocessableEntity('No subcategory found.');
        }

        $grievance = Grievance::create([
            'reference_no' => $this->generateUniqueRandomNumber(),
            'district_id' => $scheme->district_id ?? '',
            'block_id' => $scheme?->latestBlock?->block_id,
            'division_id' => $scheme->division_id,
            'scheme_id' => $scheme->id,
            'category_id' => $subCategory->category_id,
            'sub_category_id' => $validated['sub_category_id'],
            'citizen_name' => $validated['name'],
            'citizen_phone' => $validated['phone'],
            'wid' => $validated['wid'],
            'platform' => Grievance::PLATFORM_WHATSAPP,
            'type' => Grievance::TYPE_INBOUND,
            'raised_by_category' => Grievance::RAISEDBY_CITIZEN,
            'attachment' => $validated['image'] ?? '',
            'priority' => 'low',
        ]);

        return response()->json([
            'status' => 201,
            'reference_no' => $grievance->reference_no,
            'days' => $subCategory->category?->resolved_days,
        ], 201);
    }
}
