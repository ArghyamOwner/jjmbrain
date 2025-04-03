<?php

namespace App\Http\Controllers\Api\V1\Lithologs;

use App\Http\Controllers\Controller;
use App\Models\Litholog;
use App\Models\Lithology;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;

class LithologyStoreController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Litholog $litholog, Request $request)
    {
        $validate = $request->validate([
            'pattern_id' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
            // 'type' => ['required'],
            'remarks' => ['required'],
        ]);

        Lithology::create($validate + [
            'litholog_id' => $litholog->id,
        ]);
        return $this->respondCreated();
    }
}
