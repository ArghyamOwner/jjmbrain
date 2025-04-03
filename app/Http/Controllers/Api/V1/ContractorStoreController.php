<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Circle;
use App\Models\ContractorDetail;
use App\Models\Division;
use App\Models\User;
use App\Models\Zone;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractorStoreController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'entity_name' => ['required'],
            'contractor_type' => ['required'],
            'name' => ['required'],
            'gst' => ['required'],
            'registration_number' => ['nullable'],
            'pan' => ['required'],
            'phone' => ['required', 'digits:10', 'unique:users,phone'],
            'email' => ['required', 'email', 'unique:users,email'],
            'address' => ['required'],
            'bank_name' => ['nullable', 'string'],
            'branch_name' => ['nullable'],
            'account_number' => ['nullable'],
            'ifsc_code' => ['nullable'],
            'zone_id' => ['nullable'],
            'reg_dept' => ['nullable'],
            'bid_no' => ['required'],
            'license_no' => ['required'],
            'old_contractor_id' => ['required'],
            'division_id' => ['nullable'],
            'circle_id' => ['nullable'],
        ]);

        $bidExists = ContractorDetail::where('bid_no', $validated['bid_no'])
            ->orWhere('old_contractor_id', $validated['old_contractor_id'])
            ->first();
        if ($bidExists) {
            return response()->json([
                'message' => 'Contractor Data Already Exists in JJM Brain.',
            ], 422);
        }
        
        try {
            return DB::transaction(function () use ($validated) {

                $zone = Zone::where('old_zone_id', $validated['zone_id'])->first();
                $division = Division::where('old_division_id', $validated['division_id'])->first();
                $circle = Circle::where('old_circle_id', $validated['circle_id'])->first();

                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'email_verified_at' => now(),
                    'password' => bcrypt('secret'),
                    'role' => 'contractor',
                    'phone' => $validated['phone'],
                ]);

                if (!$user) {
                    return response()->json([
                        'message' => 'Invalid Data.',
                    ], 422);
                }

                $user->divisions()->sync($division);
                $user->offices()->sync($circle);

                $contractor = ContractorDetail::create([
                    'user_id' => $user->id,
                    'entity_name' => $validated['entity_name'],
                    'contractor_type' => $validated['contractor_type'],
                    'name' => $validated['name'],
                    'gst' => $validated['gst'],
                    'pan' => $validated['pan'],
                    'address' => $validated['address'],
                    'bank_name' => $validated['bank_name'],
                    'branch_name' => $validated['branch_name'],
                    'account_number' => $validated['account_number'],
                    'ifsc_code' => $validated['ifsc_code'],
                    'bid_no' => $validated['bid_no'],
                    'reg_dept' => $validated['reg_dept'],
                    'license_no' => $validated['license_no'],
                    'old_contractor_id' => $validated['old_contractor_id'],
                    'zone_id' => $zone?->id ?? null,
                ]);

                if (!$contractor) {
                    return response()->json([
                        'message' => 'Invalid Contractor Data.',
                    ], 422);
                }

                $contractor->schemeActivity()->create([
                    'user_id' => $user->id,
                    'activity_type' => 'smt_contractor_created',
                    'content' => '(SMT) New Contractor Created',
                ]);        

                return $this->respondCreated();
            });
        } catch (\Exception $e) {
            return $this->respondWithUnprocessableEntity('Something went wrong. Try again.');
        }
    }
}
