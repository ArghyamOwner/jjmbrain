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

class UpdateContractorDetailsController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke($contractor, Request $request)
    {
        $validate = $request->validate([
            'contractor_type' => ['required'],
            'name' => ['required'],
            'phone' => ['required'],
            'gst' => ['required'],
            'pan' => ['required'],
            // 'phone' => ['required'],
            'branch_name' => ['nullable'],
            'account_number' => ['required'],
            'ifsc_code' => ['required'],
            'license_no' => ['required'],
            'zone_id' => ['nullable'],
            'division_id' => ['nullable'],
            'circle_id' => ['nullable'],
        ]);

        $contractorDetail = ContractorDetail::withWhereHas('user')->where('old_contractor_id', $contractor)->first();

        if (!$contractorDetail) {
            return response()->json([
                'message' => 'Invalid Data.',
            ], 422);
        }

        $emailPhoneCheck = User::query()
            ->where('phone', $validate['phone'])
            ->where('id', '!=', $contractorDetail->user->id)
            ->exists();

        if ($emailPhoneCheck) {
            return response()->json([
                'message' => 'Phone no. already assigned to some other User.',
            ], 422);
        }

        try {
            return DB::transaction(function () use ($validate, $contractorDetail) {

                $zone = Zone::where('old_zone_id', $validate['zone_id'])->first();

                // $emailPhoneCheck = User::query()
                //     ->where(function ($query) use ($validate) {
                //         $query->where('email', $validate['email'])
                //             ->orWhere('phone', $validate['phone']);
                //     })
                //     ->where('id', '!=', $contractorDetail->user->id)
                //     ->exists();

                // if($emailPhoneCheck){
                //     return response()->json([
                //         'message' => 'Phone or Email already assigned to some other User.',
                //     ], 422);
                // }

                $contractorDetail->user->update([
                    'name' => $validate['name'],
                ]);

                $contractorDetail->update([
                    'contractor_type' => $validate['contractor_type'],
                    'gst' => $validate['gst'],
                    'pan' => $validate['pan'],
                    'branch_name' => $validate['branch_name'],
                    'account_number' => $validate['account_number'],
                    'ifsc_code' => $validate['ifsc_code'],
                    'license_no' => $validate['license_no'],
                    'zone_id' => $validate['zone_id'] ? $zone?->id : $contractorDetail->zone_id,
                ]);

                if ($validate['division_id']) {
                    $division = Division::where('old_division_id', $validate['division_id'])->first();
                    $contractorDetail->user->divisions()->sync($division);
                }

                if ($validate['circle_id']) {
                    $circle = Circle::where('old_circle_id', $validate['circle_id'])->first();
                    $contractorDetail->user->offices()->sync($circle);
                }

                $changes = $contractorDetail->getChanges();

                if (count($changes)) {
                    unset($changes['updated_at']);
                    $updatedKeys = implode(', ', array_keys($changes));

                    $contractorDetail->schemeActivity()->create([
                        'user_id' => $contractorDetail->user_id,
                        'activity_type' => 'smt_contractor_updated',
                        'content' => $updatedKeys,
                    ]);
                }

                return $this->respondOk();
            });
        } catch (\Exception $e) {
            return $this->respondWithUnprocessableEntity('Something went wrong. Try again.');
        }
    }
}
