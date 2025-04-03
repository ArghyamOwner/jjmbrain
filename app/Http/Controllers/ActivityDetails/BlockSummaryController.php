<?php

namespace App\Http\Controllers\ActivityDetails;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

class BlockSummaryController extends Controller
{
    public function index($district)
    {
        return view('activity-details.block-summary', [
            'district' => District::findOrFail($district),
        ]);
    }
}
