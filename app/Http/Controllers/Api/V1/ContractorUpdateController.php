<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ContractorDetail;
use App\Models\User;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;

class ContractorUpdateController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke($contractor, Request $request)
    {
        $validate = $request->validate([
            // 'name' => ['nullable'],
            // 'contractor_type' => ['nullable'],
            'phone' => ['nullable'],
            'email' => ['nullable'],
            // 'address' => ['nullable'],
            // 'account_number' => ['nullable'],
            // 'ifsc_code' => ['nullable'],
        ]);

        $contractorDetail = ContractorDetail::withWhereHas('user')->where('old_contractor_id', $contractor)->first();

        if (!$contractorDetail) {
            return response()->json([
                'message' => 'Invalid Data.',
            ], 422);
        }

        $emailPhoneCheck = User::query()
            ->where(function ($query) use ($validate) {
                $query->where('email', $validate['email'])
                    ->orWhere('phone', $validate['phone']);
            })
            ->where('id', '!=', $contractorDetail->user->id)
            ->exists();

        if ($emailPhoneCheck) {
            return response()->json([
                'message' => 'Phone or Email already assigned to some other User.',
            ], 422);
        }

        $contractorDetail->user->update([
            // 'name' => $validate['name'],
            'phone' => $validate['phone'],
            'email' => $validate['email'],
        ]);

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

        // $contractorDetail->update([
        //     'contractor_type' => $validate['contractor_type'],
        //     'address' => $validate['address'],
        //     'account_number' => $validate['account_number'],
        //     'ifsc_code' => $validate['ifsc_code'],
        // ]);

        return $this->respondOk();
    }
}
