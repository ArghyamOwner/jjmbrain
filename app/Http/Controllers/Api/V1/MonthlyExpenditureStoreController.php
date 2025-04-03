<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\FinancialYear;
use App\Models\MonthlyExpenditure;
use App\Models\Wuc;
use App\Traits\WithApiFileUpload;
use App\Traits\WithApiHelpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MonthlyExpenditureStoreController extends Controller
{
    use WithApiHelpers;
    use WithApiFileUpload;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            // 'month' => ['required'],
            'amount' => ['required', 'numeric'],
            'remarks' => ['nullable'],
            'expenditure_date' => ['required'],
            'image' => ['nullable'],
            'expenditure_category_id' => ['required', Rule::exists('expenditure_categories', 'id')],
        ]);

        if(! auth()->user()?->wucMember?->wuc){
            return response()->json([
                'message' => 'WUC Not Found.',
            ], 422);
        }
        $wucId = auth()->user()->wucMember->wuc_id;

        $carbonDate = \Carbon\Carbon::parse($validated['expenditure_date']);

        // Define the start of the financial year (April 1st)
        $financialYearStart = \Carbon\Carbon::create($carbonDate->year, 4, 1);

        // Check if the date is before or after the financial year start
        if ($carbonDate->lt($financialYearStart)) {
            // The date is in the previous financial year
            $financialStartYear = $carbonDate->year - 1;
        } else {
            // The date is in the current financial year
            $financialStartYear = $carbonDate->year;
        }

        $finYear = FinancialYear::where('year', $financialStartYear)->first();
        if (!$finYear) {
            return response()->json([
                'message' => 'Invalid Expenditure Date.',
            ], 422);
        }

        $expenditure = MonthlyExpenditure::create($validated + [
            'created_by' => Auth::id(),
            'wuc_id' => $wucId,
            'financial_year_id' => $finYear->id,
            'month' => Carbon::parse($validated['expenditure_date'])->format('m'),
            // 'wuc_id' => auth()->user()?->wuc?->id
        ]);

        if (!blank($validated['image'])) {
            $file = $this->createFileObject($validated['image']);

            $expenditure->update([
                'image' => $file->storePublicly('/', 'wuc'),
            ]);
        }

        return $this->respondCreated();
    }
}
