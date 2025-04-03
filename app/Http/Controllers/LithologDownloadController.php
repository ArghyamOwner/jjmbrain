<?php

namespace App\Http\Controllers;

use App\Models\Litholog;
use App\Models\Lithology;
use App\Models\WaterLevel;
use App\Services\PdfService;
use Illuminate\Http\Request;
use App\Models\CasingDiagram;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LithologDownloadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Litholog $litholog)
    {
        $litholog->load('scheme.division', 'scheme.district', 'verifiedBy');

        $lithologies = Lithology::query()
            ->with('pattern')
            ->where('litholog_id', $litholog->id)
            ->get()
            ->transform(fn($item) => [
                'from' => $item->start,
                'to' => $item->end,
                'code' => $item?->pattern?->number.'.svg',
                'code_name' => $item?->pattern?->category,
                'remarks' => $item->remarks,
            ]);
 
        $caseDiagram = CasingDiagram::query()
            ->with('pattern')
            ->where('litholog_id', $litholog->id)
            ->get()
            ->transform(fn($item) => [
                'from' => $item->start,
                'to' => $item->end,
                'code' => $item?->pattern?->number.'.svg',
                'code_name' => $item?->pattern?->category,
                'remarks' => $item->remarks,
            ]);

        $waterLevel = WaterLevel::query()
            ->with('pattern')
            ->where('litholog_id', $litholog->id)
            ->get()
            ->transform(fn($item) => [
                'from' => $item->start,
                'to' => $item->end,
                'code' => $item?->pattern?->number.'.svg',
                'code_name' => $item?->pattern?->category,
                'remarks' => $item->remarks,
            ]);
 
        return response()->stream(function () use ($lithologies, $caseDiagram, $waterLevel, $litholog) {
            echo PdfService::render(
                view('litholog-pdf', [
                    'litholog' => $litholog,
                    'lithologies' => $lithologies,
                    'caseDiagram' => $caseDiagram,
                    'waterLevel' => $waterLevel,
                    'schemeName' => $litholog?->scheme->name,
                    'division' => $litholog?->division?->name,
                    'district' => $litholog?->district?->name,
                    'verifiedBy' => $litholog->verifiedBy ? $litholog->verifiedBy->name.' ('.$litholog->verifiedBy->designation.')' : 'N/A',
                    'qrcodeLarge' => QrCode::size(80)->generate(
                        route('lithologs.show', $litholog->id)
                    ),
                ])->render()
            );
        }, 200, [
            'Content-Type' => 'application/pdf'
        ]);

        // return response()->streamDownload(function () use ($lithologies, $caseDiagram, $waterLevel, $litholog) {
        //     echo PdfService::render(
        //         view('litholog-pdf', [
        //             'lithologies' => $lithologies,
        //             'caseDiagram' => $caseDiagram,
        //             'waterLevel' => $waterLevel,
        //             'schemeName' => $litholog?->scheme->name,
        //             'division' => $litholog?->division?->name,
        //             'district' => $litholog?->district?->name,
        //             'verifiedBy' => $litholog?->verifiedBy?->name,
        //             'qrcodeLarge' => QrCode::size(80)->generate(
        //                 route('lithologs.show', $litholog->id)
        //             ),
        //         ])->render()
        //     );
        // }, 'litholog.pdf', [
        //     'Content-Type' => 'application/pdf'
        // ]);
    }
}
