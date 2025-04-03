<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
 

class SchemeQrCodeDownloadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Scheme $scheme, Request $request)
    {
        $schemeUrl = route('schemes.qrcodeDetails', $scheme->id);
        
        return response()->streamDownload(
            function () use ($schemeUrl) {
                echo QrCode::size(400)->format('png')->generate($schemeUrl);
            },
            'qr-code.png',
            [
                'Content-Type' => 'image/png',
            ]
        );
    }
}

