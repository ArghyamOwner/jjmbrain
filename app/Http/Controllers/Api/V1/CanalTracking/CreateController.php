<?php

namespace App\Http\Controllers\Api\V1\CanalTracking;

use App\Http\Controllers\Controller;
use App\Models\Scheme;
use Illuminate\Support\Str;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Scheme $scheme)
    {
        $validatedData = $request->validate([
            'type' => ['required'],
            'size' => ['required'],
            'quality' => ['required'],
        ]);

        $colors = config('freshman.pipe_size_color');

        $validatedData['created_by'] = Auth::id();
        $validatedData['color_code'] = array_key_exists($validatedData['size'], $colors) ? $colors[$validatedData['size']] : "#00f000";
        // $validatedData['color_code'] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        $validatedData['reference_no'] = Str::random(10);
        $scheme->canalTrackings()->create($validatedData);

        return $this->respondCreated();
    }
}
