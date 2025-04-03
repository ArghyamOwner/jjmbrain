<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TinymceImageUploadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $fileName = $request->file->storePublicly('/', 'helpdesk');

        return response()->json([
            'location' => Storage::disk('helpdesk')->url($fileName)
        ]);
    }
}
