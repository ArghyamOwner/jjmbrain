<?php

namespace App\Http\Controllers\Api\V1\Schemes;

use App\Http\Controllers\Controller;
use App\Models\Scheme;
use App\Models\SchemeQrReport;
use App\Traits\WithApiFileUpload;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QrReportStoreController extends Controller
{
    use WithApiHelpers;
    use WithApiFileUpload;
    
    /**
     * Handle the incoming request.
     */
    public function __invoke(Scheme $scheme, Request $request)
    {
        $validated = $request->validate([
            'latitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'photo' => ['required'],
        ]);

        $qrReport = SchemeQrReport::create($validated + [
            'user_id' => Auth::id(),
            'scheme_id' => $scheme->id
        ]);

        if (! blank($validated['photo'])) {
            $file = $this->createFileObject($validated['photo']);

            $qrReport->update([
                'photo' => $file->storePublicly('/', 'uploads')
            ]);
        }

        return $this->respondCreated();

    }
}
