<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $totals = DB::table('users')
            ->selectRaw("count(case when role = 'admin' or role = 'super-admin' then 1 end) as adminUser")
            ->selectRaw("count(case when role = 'user' then 1 end) as daoUser")
            ->first();

        return view('statistics', [
            'totals' => $totals
        ]);
    }
}
