<?php

namespace App\Http\Controllers\Api\V1\Assets;

use App\Enums\AssetCategory;
use App\Enums\AssetType;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Support\Str;
use App\Models\Scheme;
use App\Traits\WithApiFileUpload;
use App\Traits\WithApiHelpers;
use App\Traits\WithLegacyApiFcm;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreController extends Controller
{
    use WithApiHelpers;
    use WithApiFileUpload;
    use WithLegacyApiFcm;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Scheme $scheme,Request $request)
    {
        return response()->json([
            'message' => 'Option Unavailable at the moment.',
        ], 422);

        $validated = $request->validate([
            'financial_year_id' => ['required',  Rule::exists('financial_years', 'id')],
            'circle_id' => ['required', Rule::exists('circles', 'id')],
            'asset_type' => ['required', new Enum(AssetType::class)],
            'asset_category' => ['required', new Enum(AssetCategory::class)],
            'item_name' => ['required'],
            'image' => ['nullable'],
            'serial_number' => ['nullable'],
            'specification' => ['nullable'],
            'manufacturer' => ['nullable'],
            'installed_by' => ['nullable'],
            'commissioned_date' => ['nullable'],
            'warranty_period' => ['nullable'],
            'warranty_valid_upto' => ['nullable'],
            'service_provided_by' => ['nullable'],
            'service_cycle' => ['nullable'],
            'remarks' => ['nullable'],
        ]);
        
        $asset = Asset::create($validated + [
            'scheme_id' => $scheme->id,
        ]);

        if (! blank($validated['image'])) {
            $file = $this->createFileObject($validated['image']);

            $asset->update([
                'image' => $file->storePublicly('/', 'uploads')
            ]);
        }

        foreach(auth()->user()->tokens()->tobase()->get('name')->unique('name') as $token){
            if (Str::length($token->name) > 25) {
                $this->notifyFcm($token->name, ['title' => "Asset Created", 'body' => "Assets Created for Scheme : ".$scheme->name ]);
            }
        }

        return $this->respondCreated();
    }
}
