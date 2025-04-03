<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'file' => ['required', 'image', 'max:5048']
        ]);

        if ($request->file('file')) {
            if (is_array($request->file)) {
                $path = collect($request->file)->map->store('/tmp-uploads', 'public');
            } else {
                $path = $request->file->store('/tmp-uploads', 'public');
            }

            return response()->json([
                'url' => $path
            ], 200);
        }

        return response()->json([
            'url' => ''
        ], 200);
    }
}
