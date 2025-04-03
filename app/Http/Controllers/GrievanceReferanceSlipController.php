<?php

namespace App\Http\Controllers;

use App\Models\Grievance;
use Illuminate\Http\Request;
use Mpdf\Output\Destination;
use App\Services\MpdfService;

class GrievanceReferanceSlipController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Grievance $grievance)
    {
        $ref = $grievance->reference_no;
        $date = $grievance->created_at->format('d/m/Y');
        $url = route('publicGrievance.status', ['ref_number' => $ref ]);

        $content = view('grievance-referance-slip-download', [
            'refNo' => $ref,
            'date' => $date,
            'url' => $url
        ])->render();

        $mpdf = new \Mpdf\Mpdf(array_merge([
            'tempDir' => base_path('storage/app/mpdf')
        ]));

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;

        $mpdf->WriteHTML($content);

        return $mpdf->Output("ticket_{$ref}.pdf", Destination::INLINE);
    }
}
