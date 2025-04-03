<?php

namespace App\Http\Controllers\Api\V1\District;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $districts = District::query()
            ->orderBy('name')
            ->get();

        $formattedResponse = '';
        foreach ($districts as $district) {
            $formattedResponse .= ($district->id) . '. ' . $district->name . "\n";
        }
        $data = ['districts' => $formattedResponse];
        return response()->json($data);
    }
}
