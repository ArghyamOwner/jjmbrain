<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictViewController extends Controller
{
    public function index(District $district)
    {
        return view('district-view', [
            'district' => $district,
        ]);
    }
}
