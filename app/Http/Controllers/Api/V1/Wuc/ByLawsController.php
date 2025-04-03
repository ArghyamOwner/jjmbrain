<?php

namespace App\Http\Controllers\Api\V1\Wuc;

use App\Http\Controllers\Controller;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ByLawsController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = [
            [
                "en_text" => "Bylaw in Assamaese",
                "hn_text" => "असमिया में उपविधि",
                "bn_text" => "অসমিয়া ভাষায় উপবিধি",
                "as_text" => "উপ-বিধি অসমীয়া ভাষাত",
                "link" => "https://sumatoimg.nyc3.digitaloceanspaces.com/jjm/wuc/bylaw-assamese.pdf",
                "updated" => "23-01-2024",
            ],
            [
                "en_text" => "Bylaw in English",
                "hn_text" => "अंग्रेजी में उपविधि",
                "bn_text" => "ইংরেজিতে উপবিধি",
                "as_text" => "ইংৰাজীত উপ-বিধি",
                "link" => "https://sumatoimg.nyc3.digitaloceanspaces.com/jjm/wuc/bylaw-english.pdf",
                "updated" => "23-01-2024",
            ],
        ];
        return $this->respondWithSuccess(
            $data,
            Response::HTTP_OK,
            'ByLaws'
        );
    }
}
