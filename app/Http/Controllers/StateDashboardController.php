<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StateDashboardController extends Controller
{
    public function index(){
        return view('state-dashboard-view');
    }
}
