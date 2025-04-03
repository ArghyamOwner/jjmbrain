<?php

namespace App\Http\Controllers\Api\V1\Wuc;

use App\Http\Controllers\Controller;
use App\Models\OAndMCollection;
use App\Models\Wuc;
use App\Traits\WithApiFileUpload;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OAndMCollectionStoreController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Wuc $wuc, Request $request)
    {
        $validated = $request->validate([
            'financial_year_id' => ['required',  Rule::exists('financial_years', 'id')],
            'month' => ['required'],
            'household' => ['required', 'numeric'],
        ]);
        OAndMCollection::create($validated + [
            'wuc_id' => $wuc->id
        ]);

        return $this->respondCreated();
    }
}
