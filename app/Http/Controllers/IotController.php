<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IotController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $response = Http::withHeaders([
            'x-api-key' => 'ASr1XDnR6gdg'
        ])
        ->get('http://zseesmart.com/zsee_assam/get/systemData', [
            'systemId' => '1',
            'siteId' => 'ASMDB1',
        ]);

        return view('iot', [
            'response' => $response->ok() && $response['status'] == 1 
                ? $response['data']
                : null 
        ]);
    }
}
