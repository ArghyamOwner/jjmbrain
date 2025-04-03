<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MpdfService;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;

class DemoPdfController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    { 
        // $phpWord = new PhpWord();
        // $section = $phpWord->addSection();

        $content = view('demo-pdf', [
            'serialNo' => 1234,
            'name' => 'Fardeen Khan',
            'address' => 'IEI Building',
            'rollNo' => 12345678,
            'postName' => 'Class III',
            'payscale' => 'Class III',
            'office' => 'Govt. Office',
        ])->render();

        // Html::addHtml($section, $content);
        // $phpWord->save('sample.docx', 'Word2007');

        // $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        // $objWriter->save('sample.docx');

        return MpdfService::make($content)->stream();
    }
}
