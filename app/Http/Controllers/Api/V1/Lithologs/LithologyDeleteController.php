<?php

namespace App\Http\Controllers\Api\V1\Lithologs;

use App\Http\Controllers\Controller;
use App\Models\Litholog;
use App\Models\Lithology;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;

class LithologyDeleteController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Litholog $litholog, Request $request)
    {
        Lithology::where('litholog_id', $litholog->id)->delete();
        return $this->respondOk();
    }
}
